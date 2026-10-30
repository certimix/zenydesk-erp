<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class TenantModuleAccessMiddleware
{
    /**
     * E-mails oficiais dos 7 usuários da empresa com Plano Completo (100% Liberado)
     */
    public const COMPANY_EMAILS = [
        'admin@zenydesk.com',
        'eduardo.suporte@certimix.com.br',
        'ellen.suporte@certimix.com.br',
        'jacielle.suporte@certimix.com.br',
        'certimixx@gmail.com',
        'c.eduardo.j.s22@gmail.com',
        'suportecertimix@gmail.com',
    ];

    /**
     * Mapeamento de rotas para módulos requeridos
     */
    protected const MODULE_ROUTES = [
        'accounting'    => ['admin/accounting'],
        'purchases'     => ['admin/purchase', 'admin/purchases'],
        'projects'      => ['admin/project', 'admin/projects'],
        'pos'           => ['admin/point-of-sale', 'admin/pos', 'admin/barcode-app'],
        'employees'     => ['admin/employee', 'admin/employees', 'admin/time-off', 'admin/recruitment', 'admin/timesheet'],
        'manufacturing' => ['admin/manufacturing', 'admin/maintenance'],
    ];

    public function handle(Request $request, Closure $next): Response
    {
        // 1. Regra de Ouro: Os 7 membros oficiais da empresa possuem PLANO COMPLETO (100% Liberado)
        if ($this->isCompanyInternalUser()) {
            return $next($request);
        }

        // 2. Identifica o tenant ativo
        $tenant = $request->attributes->get('tenant');

        if (! $tenant) {
            $host = strtolower(explode(':', $request->getHost())[0]);
            if (preg_match('/^([a-z0-9\-]+)\.erp\.zenydesk\.com$/', $host, $m)) {
                $sub = $m[1];
                if ($sub !== 'erp' && $sub !== 'www') {
                    $tenant = DB::table('zeny_erp_tenants')->where('subdominio', $sub)->first();
                    if ($tenant) {
                        $request->attributes->set('tenant', $tenant);
                    }
                }
            }
        }

        if (! $tenant && Auth::check() && Auth::user()->default_company_id) {
            $company = DB::table('companies')->where('id', Auth::user()->default_company_id)->first();
            if ($company && ! empty($company->subdominio) && $company->subdominio !== 'erp') {
                $tenant = DB::table('zeny_erp_tenants')->where('subdominio', $company->subdominio)->first();
                if ($tenant) {
                    $request->attributes->set('tenant', $tenant);
                }
            }
        }

        // Se não for um tenant contratante externo, libera
        if (! $tenant) {
            return $next($request);
        }

        // 3. Lê os módulos ativos contratados pelo cliente no checkout / calculadora
        $activeModules = json_decode($tenant->modulos ?: '[]', true) ?: [];
        $path = trim($request->path(), '/');

        // 4. Se o cliente tentar acessar diretamente a URL de um módulo não contratado, bloqueia com aviso
        foreach (self::MODULE_ROUTES as $moduleKey => $routePrefixes) {
            foreach ($routePrefixes as $prefix) {
                if (str_starts_with($path, $prefix)) {
                    if (! in_array($moduleKey, $activeModules, true)) {
                        session()->flash('notification', [
                            'title'  => 'Módulo Não Contratado',
                            'body'   => 'Este recurso não faz parte dos módulos contratados para o seu plano. Entre em contato ou faça upgrade para liberá-lo instantaneamente.',
                            'status' => 'warning',
                        ]);

                        return redirect()->to('/admin');
                    }
                }
            }
        }

        return $next($request);
    }

    /**
     * Verifica se o usuário autenticado é um dos 7 membros da equipe interna da empresa
     */
    protected function isCompanyInternalUser(): bool
    {
        if (! Auth::check()) {
            return false;
        }

        $user = Auth::user();
        $email = strtolower(trim((string) $user->email));

        if (in_array($email, self::COMPANY_EMAILS, true) || $user->id <= 7) {
            return true;
        }

        if (isset($user->default_company_id) && (int) $user->default_company_id === 1) {
            return true;
        }

        return false;
    }
}
