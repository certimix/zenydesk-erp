<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Webkul\Security\Models\User;
use Webkul\Support\Models\Company;

class SubscriptionController extends Controller
{
    /**
     * Módulos disponíveis e seus respectivos preços (em BRL)
     */
    public const MODULE_PRICES = [
        'accounting'    => ['name' => 'Contabilidade Plena (Plano de Contas, Diário, Razão, DFC)', 'price' => 49.90],
        'employees'     => ['name' => 'Recursos Humanos & Folha de Pagamento', 'price' => 39.90],
        'pos'           => ['name' => 'Frente de Caixa & Ponto de Venda (PDV)', 'price' => 34.90],
        'purchases'     => ['name' => 'Compras Estruturadas & Cotações Avançadas', 'price' => 29.90],
        'projects'      => ['name' => 'Gestão de Projetos, Tarefas & Quadro Kanban', 'price' => 24.90],
        'manufacturing' => ['name' => 'Manutenção Industrial & Produção (BOM)', 'price' => 49.90],
    ];

    public const BASE_PRICE = 79.90;
    public const COMBO_PRICE = 189.90;

    public function index(): View
    {
        return $this->show();
    }

    public function show(): View
    {
        return view('subscription.index', [
            'basePrice'    => self::BASE_PRICE,
            'comboPrice'   => self::COMBO_PRICE,
            'modulePrices' => self::MODULE_PRICES,
        ]);
    }

    public function checkSubdomain(Request $request): JsonResponse
    {
        $sub = strtolower(trim((string) $request->query('subdominio', '')));
        $sub = preg_replace('/[^a-z0-9\-]/', '', $sub);

        if (strlen($sub) < 3) {
            return response()->json(['available' => false, 'message' => 'O subdomínio deve ter pelo menos 3 caracteres.']);
        }

        $reserved = ['admin', 'api', 'app', 'www', 'erp', 'mail', 'webmail', 'demo', 'teste', 'staging'];
        if (in_array($sub, $reserved, true)) {
            return response()->json(['available' => false, 'message' => 'Este subdomínio é reservado pelo sistema.']);
        }

        $exists = DB::table('zeny_erp_tenants')->where('subdominio', $sub)->exists()
               || DB::table('companies')->where('subdominio', $sub)->exists();

        if ($exists) {
            return response()->json(['available' => false, 'message' => 'Este subdomínio já está em uso por outra empresa.']);
        }

        return response()->json(['available' => true, 'message' => "https://{$sub}.erp.zenydesk.com está disponível!"]);
    }

    public function checkout(Request $request): JsonResponse
    {
        $request->validate([
            'nome_empresa'   => 'required|string|max:255',
            'responsavel'    => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'telefone'       => 'required|string|max:50',
            'cpf_cnpj'       => 'required|string|max:30',
            'senha'          => 'required|string|min:6',
            'subdominio'     => 'required|string|min:3|max:50|regex:/^[a-z0-9\-]+$/',
            'forma_pagamento'=> 'required|in:PIX,CREDIT_CARD',
        ]);

        $sub = strtolower(trim($request->input('subdominio')));
        $sub = preg_replace('/[^a-z0-9\-]/', '', $sub);

        // Verifica unicidade
        $exists = DB::table('zeny_erp_tenants')->where('subdominio', $sub)->exists()
               || DB::table('companies')->where('subdominio', $sub)->exists();
        if ($exists) {
            return response()->json(['success' => false, 'error' => 'O subdomínio informado já foi cadastrado por outro cliente.']);
        }

        // Calcula valor final
        $isCombo = (bool) $request->input('is_combo', false);
        $selectedModules = (array) $request->input('modulos', []);

        if ($isCombo) {
            $valorTotal = self::COMBO_PRICE;
            $modulosAtivos = array_keys(self::MODULE_PRICES);
        } else {
            $valorTotal = self::BASE_PRICE;
            $modulosAtivos = [];
            foreach ($selectedModules as $mKey) {
                if (isset(self::MODULE_PRICES[$mKey])) {
                    $valorTotal += self::MODULE_PRICES[$mKey]['price'];
                    $modulosAtivos[] = $mKey;
                }
            }
        }

        $apiKey = env('ASAAS_API_KEY');
        $isProd = env('ASAAS_PRODUCTION', true);
        $endpoint = $isProd ? 'https://api.asaas.com/v3' : 'https://sandbox.asaas.com/api/v3';
        $devWalletId = env('ASAAS_DEV_WALLET_ID', '2137ec9f-9cd0-4565-8f7e-e00223df9ebd');

        $cpfCnpjRaw = preg_replace('/\D/', '', $request->input('cpf_cnpj'));
        $telefoneRaw = preg_replace('/\D/', '', $request->input('telefone'));

        // 1. Cria ou localiza cliente no Asaas
        $customerId = $this->getOrCreateAsaasCustomer($endpoint, $apiKey, [
            'name'        => $request->input('nome_empresa'),
            'email'       => $request->input('email'),
            'cpfCnpj'     => $cpfCnpjRaw,
            'mobilePhone' => $telefoneRaw,
        ]);

        if (! $customerId) {
            return response()->json(['success' => false, 'error' => 'Falha ao registrar cliente junto ao gateway de pagamento bancário.']);
        }

        // Split oficial: 45% Dev / 55% Dono
        $splitArray = [];
        if (! empty($devWalletId)) {
            $splitArray[] = [
                'walletId'        => $devWalletId,
                'percentualValue' => 45,
            ];
        }

        $txid = 'ZENY-ERP-' . strtoupper($sub) . '-' . time();

        // 2. Fluxo Pix
        if ($request->input('forma_pagamento') === 'PIX') {
            $payloadPix = [
                'customer'          => $customerId,
                'billingType'       => 'PIX',
                'value'             => $valorTotal,
                'dueDate'           => date('Y-m-d', strtotime('+1 day')),
                'description'       => "Assinatura ZENYDESK.ERP [{$sub}.erp.zenydesk.com]",
                'externalReference' => $txid,
            ];
            if (! empty($splitArray)) {
                $payloadPix['split'] = $splitArray;
            }

            $respPayment = $this->callAsaas($endpoint . '/payments', $apiKey, 'POST', $payloadPix);
            if (empty($respPayment['id'])) {
                $err = $respPayment['errors'][0]['description'] ?? 'Erro ao emitir cobrança Pix no Asaas.';
                return response()->json(['success' => false, 'error' => $err]);
            }

            $paymentId = $respPayment['id'];
            $pixData = $this->callAsaas($endpoint . "/payments/{$paymentId}/pixQrCode", $apiKey, 'GET');

            // Salva tenant pendente
            DB::table('zeny_erp_tenants')->insert([
                'subdominio'        => $sub,
                'nome_empresa'      => $request->input('nome_empresa'),
                'responsavel'       => $request->input('responsavel'),
                'email'             => strtolower(trim($request->input('email'))),
                'telefone'          => $request->input('telefone'),
                'cpf_cnpj'          => $request->input('cpf_cnpj'),
                'modulos'           => json_encode($modulosAtivos),
                'valor_mensal'      => $valorTotal,
                'status'            => 'pendente',
                'forma_pagamento'   => 'PIX',
                'asaas_customer_id' => $customerId,
                'asaas_payment_id'  => $paymentId,
                'txid'              => $txid,
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);

            // Guarda senha em cache de provisionamento até o webhook aprovar
            cache()->put("tenant_pwd_{$sub}", $request->input('senha'), 86400);

            return response()->json([
                'success'           => true,
                'type'              => 'PIX',
                'payment_method'    => 'PIX',
                'qrCodeImage'       => $pixData['encodedImage'] ?? null,
                'pix_qrcode_image'  => $pixData['encodedImage'] ?? null,
                'copiaECola'        => $pixData['payload'] ?? null,
                'pix_copia_cola'    => $pixData['payload'] ?? null,
                'valor'             => number_format($valorTotal, 2, ',', '.'),
                'subdominio'        => $sub,
                'urlDestino'        => "https://{$sub}.erp.zenydesk.com/admin",
                'redirect_url'      => "https://{$sub}.erp.zenydesk.com/admin",
            ]);
        }

        // 3. Fluxo Cartão de Crédito
        if ($request->input('forma_pagamento') === 'CREDIT_CARD') {
            $cardNumber = preg_replace('/\D/', '', $request->input('card_number', ''));
            $cardHolder = trim($request->input('card_holder', ''));
            $cardMonth  = trim($request->input('card_expiry_month', ''));
            $cardYear   = trim($request->input('card_expiry_year', ''));
            $cardCvv    = preg_replace('/\D/', '', $request->input('card_cvv', ''));
            $cardPostal = preg_replace('/\D/', '', $request->input('postal_code', ''));
            $cardAddrNr = trim($request->input('address_number', ''));

            $fullYear = (strlen($cardYear) === 2) ? '20' . $cardYear : $cardYear;

            $payloadCard = [
                'customer'          => $customerId,
                'billingType'       => 'CREDIT_CARD',
                'value'             => $valorTotal,
                'nextDueDate'       => date('Y-m-d'),
                'cycle'             => 'MONTHLY',
                'description'       => "Assinatura Mensal ZENYDESK.ERP [{$sub}.erp.zenydesk.com]",
                'externalReference' => $txid,
                'creditCard'        => [
                    'holderName'  => strtoupper($cardHolder),
                    'number'      => $cardNumber,
                    'expiryMonth' => str_pad($cardMonth, 2, '0', STR_PAD_LEFT),
                    'expiryYear'  => $fullYear,
                    'ccv'         => $cardCvv,
                ],
                'creditCardHolderInfo' => [
                    'name'          => strtoupper($cardHolder ?: $request->input('responsavel')),
                    'email'         => $request->input('email'),
                    'cpfCnpj'       => $cpfCnpjRaw,
                    'postalCode'    => $cardPostal,
                    'addressNumber' => $cardAddrNr,
                    'phone'         => $telefoneRaw,
                ],
            ];
            if (! empty($splitArray)) {
                $payloadCard['split'] = $splitArray;
            }

            $respSub = $this->callAsaas($endpoint . '/subscriptions', $apiKey, 'POST', $payloadCard);
            if (empty($respSub['id'])) {
                $err = $respSub['errors'][0]['description'] ?? 'Transação de cartão de crédito não autorizada pela operadora.';
                return response()->json(['success' => false, 'error' => $err]);
            }

            $subId = $respSub['id'];

            // Salva tenant e provisiona imediatamente
            $tenantId = DB::table('zeny_erp_tenants')->insertGetId([
                'subdominio'             => $sub,
                'nome_empresa'           => $request->input('nome_empresa'),
                'responsavel'            => $request->input('responsavel'),
                'email'                  => strtolower(trim($request->input('email'))),
                'telefone'               => $request->input('telefone'),
                'cpf_cnpj'               => $request->input('cpf_cnpj'),
                'modulos'                => json_encode($modulosAtivos),
                'valor_mensal'           => $valorTotal,
                'status'                 => 'ativo',
                'forma_pagamento'        => 'CREDIT_CARD',
                'asaas_customer_id'      => $customerId,
                'asaas_subscription_id'  => $subId,
                'txid'                   => $txid,
                'created_at'             => now(),
                'updated_at'             => now(),
            ]);

            // Provisiona ambiente do cliente no ERP
            $this->provisionTenantEnvironment($sub, $request->input('nome_empresa'), $request->input('responsavel'), $request->input('email'), $request->input('senha'));

            return response()->json([
                'success'    => true,
                'type'       => 'CREDIT_CARD',
                'redirectUrl'=> "https://{$sub}.erp.zenydesk.com/admin",
            ]);
        }

        return response()->json(['success' => false, 'error' => 'Forma de pagamento não suportada.']);
    }

    public function status(string $subdominio): JsonResponse
    {
        return $this->checkStatus($subdominio);
    }

    public function checkStatus(string $subdominio): JsonResponse
    {
        $tenant = DB::table('zeny_erp_tenants')->where('subdominio', $subdominio)->first();
        if (! $tenant) {
            return response()->json(['found' => false]);
        }

        return response()->json([
            'found'        => true,
            'status'       => $tenant->status,
            'redirectUrl'  => "https://{$subdominio}.erp.zenydesk.com/admin",
            'redirect_url' => "https://{$subdominio}.erp.zenydesk.com/admin",
        ]);
    }

    public function provisionTenantEnvironment(string $sub, string $empresa, string $responsavel, string $email, string $senha): void
    {
        // 1. Cria ou atualiza a empresa em companies
        $companyId = DB::table('companies')->where('subdominio', $sub)->value('id');
        if (! $companyId) {
            $companyId = DB::table('companies')->insertGetId([
                'name'        => $empresa,
                'subdominio'  => $sub,
                'is_active'   => 1,
                'partner_id'  => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        } else {
            DB::table('companies')->where('id', $companyId)->update([
                'name'        => $empresa,
                'subdominio'  => $sub,
                'updated_at'  => now(),
            ]);
        }
        $company = Company::find($companyId);

        // 2. Cria o usuário administrador do tenant se não existir
        $user = User::whereRaw('LOWER(email) = ?', [strtolower(trim($email))])->first();
        if (! $user) {
            $user = User::create([
                'name'                => $responsavel,
                'email'               => strtolower(trim($email)),
                'password'            => Hash::make($senha),
                'is_active'           => 1,
                'default_company_id'  => $company->id,
                'resource_permission' => 'global',
                'language'            => 'pt_BR',
            ]);
        } else {
            $user->default_company_id = $company->id;
            $user->save();
        }

        // 3. Vincula user_allowed_companies
        DB::table('user_allowed_companies')->updateOrInsert(
            ['user_id' => $user->id, 'company_id' => $company->id],
            ['user_id' => $user->id, 'company_id' => $company->id]
        );

        // 4. Vincula role Admin (ID: 1)
        DB::table('model_has_roles')->updateOrInsert(
            ['role_id' => 1, 'model_type' => 'Webkul\\Security\\Models\\User', 'model_id' => $user->id],
            ['role_id' => 1, 'model_type' => 'Webkul\\Security\\Models\\User', 'model_id' => $user->id]
        );

        // 5. Atualiza o tenant com o company_id e admin_user_id
        DB::table('zeny_erp_tenants')->where('subdominio', $sub)->update([
            'company_id'    => $company->id,
            'admin_user_id' => $user->id,
            'status'        => 'ativo',
            'updated_at'    => now(),
        ]);

        Log::info("Tenant [{$sub}] provisionado com sucesso para a empresa '{$empresa}' (User: {$email})");
    }

    protected function getOrCreateAsaasCustomer(string $endpoint, string $apiKey, array $data): ?string
    {
        $cpfCnpj = urlencode($data['cpfCnpj']);
        $search = $this->callAsaas("{$endpoint}/customers?cpfCnpj={$cpfCnpj}", $apiKey, 'GET');

        if (! empty($search['data'][0]['id'])) {
            return $search['data'][0]['id'];
        }

        $create = $this->callAsaas("{$endpoint}/customers", $apiKey, 'POST', $data);
        return $create['id'] ?? null;
    }

    protected function callAsaas(string $url, string $apiKey, string $method = 'GET', array $payload = []): array
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);

        $headers = [
            'access_token: ' . $apiKey,
            'Content-Type: application/json',
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        }

        $resp = curl_exec($ch);
        curl_close($ch);

        return $resp ? (json_decode($resp, true) ?: []) : [];
    }
}
