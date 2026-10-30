<?php

use App\Http\Controllers\Api\AsaasWebhookController;
use Illuminate\Support\Facades\Route;

Route::post('/webhook/asaas', [AsaasWebhookController::class, 'handle'])->name('api.webhook.asaas');
