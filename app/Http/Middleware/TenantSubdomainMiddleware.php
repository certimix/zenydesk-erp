<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Webkul\Support\Models\Company;
use Webkul\Support\Services\CompanyContext;

class TenantSubdomainMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $host = strtolower(explode(':', $request->getHost())[0]);

        // Verifica se é um subdomínio tenant: [subdominio].erp.zenydesk.com
        if (preg_match('/^([a-z0-9\-]+)\.erp\.zenydesk\.com$/', $host, $matches)) {
            $sub = $matches[1];

            if ($sub !== 'erp' && $sub !== 'www') {
                $tenant = DB::table('zeny_erp_tenants')->where('subdominio', $sub)->first();
                $company = Company::where('subdominio', $sub)->first();

                if (! $tenant && ! $company) {
                    // Subdomínio não cadastrado -> redireciona para a página de contratação
                    return redirect()->away("https://erp.zenydesk.com/assinar?sub={$sub}");
                }

                if ($tenant && $tenant->status === 'pendente') {
                    return response("<h3>Ambiente {$sub}.erp.zenydesk.com aguardando ativação do pagamento.</h3><p>Se você acabou de realizar o pagamento Pix ou Cartão, aguarde 1 minuto e atualize a página.</p>", 402);
                }

                if ($tenant && $tenant->status === 'suspenso') {
                    return response("<h3>Ambiente suspenso por pendência financeira. Entre em contato com o suporte.</h3>", 403);
                }

                // Injeta no request
                $request->attributes->set('tenant', $tenant);
                $request->attributes->set('tenant_subdomain', $sub);
                $request->attributes->set('tenant_company', $company);

                if ($company) {
                    session([CompanyContext::SESSION_KEY => [$company->id]]);
                }
            }
        }

        return $next($request);
    }
}
