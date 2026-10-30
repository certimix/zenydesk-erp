<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AsaasWebhookController extends Controller
{
    public function handle(Request $request): JsonResponse
    {
        $payload = $request->all();
        $event = $payload['event'] ?? '';
        $payment = $payload['payment'] ?? [];

        Log::info("Asaas Webhook recebido: Evento={$event}, PaymentID=" . ($payment['id'] ?? 'N/A'));

        if (in_array($event, ['PAYMENT_RECEIVED', 'PAYMENT_CONFIRMED'], true)) {
            $paymentId = $payment['id'] ?? null;
            $extRef    = $payment['externalReference'] ?? null;
            $custId    = $payment['customer'] ?? null;

            // Busca tenant pendente por payment_id, txid ou customer_id
            $tenant = DB::table('zeny_erp_tenants')
                ->where('status', 'pendente')
                ->where(function ($q) use ($paymentId, $extRef, $custId) {
                    if ($paymentId) $q->orWhere('asaas_payment_id', $paymentId);
                    if ($extRef)    $q->orWhere('txid', $extRef);
                    if ($custId)    $q->orWhere('asaas_customer_id', $custId);
                })
                ->first();

            if ($tenant) {
                $sub = $tenant->subdominio;
                $cachedPwd = cache()->pull("tenant_pwd_{$sub}") ?: substr(preg_replace('/\D/', '', $tenant->cpf_cnpj), 0, 6);

                $controller = new SubscriptionController();
                $controller->provisionTenantEnvironment(
                    $sub,
                    $tenant->nome_empresa,
                    $tenant->responsavel,
                    $tenant->email,
                    $cachedPwd
                );

                Log::info("Webhook: Tenant [{$sub}] ativado e provisionado com sucesso pelo evento {$event}!");
            }
        }

        return response()->json(['received' => true]);
    }
}
