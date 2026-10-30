<?php

use App\Http\Controllers\HelpDocController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::redirect('/admin-login', '/admin/login')
    ->name('login');

// Assinatura e Checkout Multi-Tenant
Route::get('/assinar', [SubscriptionController::class, 'show'])->name('subscription.index');
Route::post('/assinar/check-subdomain', [SubscriptionController::class, 'checkSubdomain'])->name('subscription.check-subdomain');
Route::post('/assinar/checkout', [SubscriptionController::class, 'checkout'])->name('subscription.checkout');
Route::get('/assinar/status/{subdominio}', [SubscriptionController::class, 'status'])->name('subscription.status');

// Central de Ajuda & Documentação do ERP
Route::prefix('admin/help')->group(function () {
    Route::get('/cloud-hosting', [HelpDocController::class, 'cloudHosting'])->name('help.cloud-hosting');
    Route::get('/support-maintenance', [HelpDocController::class, 'supportMaintenance'])->name('help.support-maintenance');
    Route::get('/custom-services', [HelpDocController::class, 'customServices'])->name('help.custom-services');
    Route::get('/modules', [HelpDocController::class, 'modules'])->name('help.modules');
    Route::get('/dev-docs', [HelpDocController::class, 'devDocs'])->name('help.dev-docs');
    Route::get('/user-guide', [HelpDocController::class, 'userGuide'])->name('help.user-guide');
});
