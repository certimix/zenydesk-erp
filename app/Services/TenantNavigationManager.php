<?php

namespace App\Services;

use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Navigation\NavigationManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TenantNavigationManager extends NavigationManager
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
     * Mapeamento de chaves de módulos para padrões de URL
     */
    protected const MODULE_URL_PATTERNS = [
        'accounting'    => ['/accounting'],
        'purchases'     => ['/purchase'],
        'projects'      => ['/project'],
        'pos'           => ['/point-of-sale', '/pos', '/barcode'],
        'employees'     => ['/employee', '/time-off', '/recruitment', '/timesheet'],
        'manufacturing' => ['/manufacturing', '/maintenance'],
    ];

    /**
     * Mapeamento de chaves de módulos para rótulos/nomes de NavigationGroup
     */
    protected const MODULE_GROUP_NAMES = [
        'accounting'    => ['accounting', 'contabilidade', 'faturamento'],
        'purchases'     => ['purchase', 'compras', 'compras estruturadas'],
        'projects'      => ['project', 'projetos', 'kanban'],
        'pos'           => ['point-of-sale', 'pointofsale', 'barcode', 'pdv', 'frente de caixa'],
        'employees'     => ['employee', 'time-off', 'timeoff', 'recruitment', 'timesheet', 'rh', 'funcionários', 'funcionarios'],
        'manufacturing' => ['manufacturing', 'maintenance', 'manutenção', 'manutencao', 'produção', 'producao', 'bom'],
    ];

    public function get(): array
    {
        $groups = parent::get();

        // 1. Regra de Ouro: Os 7 usuários oficiais da empresa possuem PLANO COMPLETO (100% Liberado)
        if ($this->isCompanyInternalUser()) {
            return $groups;
        }

        // 2. Identifica o tenant contratante ativo
        $tenant = $this->resolveActiveTenant();

        // Se for o painel central mestre sem subdomínio específico de cliente, libera menus
        if (! $tenant) {
            return $groups;
        }

        // 3. Lê os módulos contratados pelo cliente no checkout / calculadora
        $activeModules = json_decode($tenant->modulos ?: '[]', true) ?: [];

        // 4. Filtra grupos e itens estritamente conforme o plano contratado
        return collect($groups)
            ->map(function (NavigationGroup $group) use ($activeModules) {
                $groupKey = strtolower((string) ($group->getLabel() ?: ''));

                // Se o próprio grupo pertencer a um módulo não contratado, oculta
                foreach (self::MODULE_GROUP_NAMES as $mod => $names) {
                    if (! in_array($mod, $activeModules, true)) {
                        foreach ($names as $name) {
                            if (str_contains($groupKey, $name)) {
                                return null;
                            }
                        }
                    }
                }

                $filteredItems = collect($group->getItems())->filter(function (NavigationItem $item) use ($activeModules) {
                    $url = strtolower((string) ($item->getUrl() ?: ''));

                    foreach (self::MODULE_URL_PATTERNS as $mod => $patterns) {
                        if (! in_array($mod, $activeModules, true)) {
                            foreach ($patterns as $pattern) {
                                if (str_contains($url, $pattern)) {
                                    return false;
                                }
                            }
                        }
                    }

                    return true;
                })->values()->all();

                if (empty($filteredItems)) {
                    return null;
                }

                $group->items($filteredItems);
                return $group;
            })
            ->filter()
            ->values()
            ->all();
    }

    /**
     * Verifica se o usuário autenticado é um dos 7 membros da equipe interna da empresa
     */
    public function isCompanyInternalUser(): bool
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

    protected function resolveActiveTenant(): ?object
    {
        $tenant = request()->attributes->get('tenant');
        if ($tenant) {
            return $tenant;
        }

        $host = strtolower(explode(':', request()->getHost())[0]);
        if (preg_match('/^([a-z0-9\-]+)\.erp\.zenydesk\.com$/', $host, $m)) {
            $sub = $m[1];
            if ($sub !== 'erp' && $sub !== 'www') {
                $tenant = DB::table('zeny_erp_tenants')->where('subdominio', $sub)->first();
                if ($tenant) {
                    request()->attributes->set('tenant', $tenant);
                    return $tenant;
                }
            }
        }

        if (Auth::check() && Auth::user()->default_company_id) {
            $company = DB::table('companies')->where('id', Auth::user()->default_company_id)->first();
            if ($company && ! empty($company->subdominio) && $company->subdominio !== 'erp') {
                $tenant = DB::table('zeny_erp_tenants')->where('subdominio', $company->subdominio)->first();
                if ($tenant) {
                    request()->attributes->set('tenant', $tenant);
                    return $tenant;
                }
            }
        }

        return null;
    }
}
