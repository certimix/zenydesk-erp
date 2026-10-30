<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Webkul\Security\Models\User;

class GoogleAuthController extends Controller
{
    /**
     * Redireciona o usuário para o formulário de login do Google (fluxo OAuth tradicional).
     */
    public function redirect(): RedirectResponse
    {
        $clientId = config('services.google.client_id');
        $clientSecret = config('services.google.client_secret');

        if (empty($clientId) || empty($clientSecret)) {
            return redirect()->to('/admin/login')
                ->with('error', 'Login tradicional requer Client Secret. Utilize o botão oficial do Google na tela de login.');
        }

        return Socialite::driver('google')->redirect();
    }

    /**
     * Recebe o retorno da autenticação do Google (via Socialite GET ou via GIS POST com JWT credential).
     */
    public function callback(Request $request): RedirectResponse
    {
        $email = null;
        $name = null;

        // 1. Fluxo Google Identity Services (POST com credential JWT)
        $credential = $request->input('credential');
        if (! empty($credential)) {
            try {
                // Valida o id_token diretamente com a API oficial do Google
                $response = Http::timeout(8)->get("https://oauth2.googleapis.com/tokeninfo", [
                    'id_token' => $credential,
                ]);

                if ($response->successful()) {
                    $tokenData = $response->json();

                    $iss = $tokenData['iss'] ?? '';
                    $aud = $tokenData['aud'] ?? '';
                    $expectedClientId = config('services.google.client_id') ?: '615444982313-dvtl6p7jtb7smte977430comtvu118ge.apps.googleusercontent.com';

                    if (str_contains($iss, 'accounts.google.com') && $aud === $expectedClientId) {
                        $email = strtolower(trim((string) ($tokenData['email'] ?? '')));
                        $name  = $tokenData['name'] ?? null;
                    } else {
                        Log::warning("Token Google recebido com emissor/audiência inesperados: iss={$iss}, aud={$aud}");
                    }
                } else {
                    Log::error("Google tokeninfo retornou erro: " . $response->body());
                }
            } catch (\Throwable $e) {
                Log::error('Erro ao validar token GIS do Google: ' . $e->getMessage());
            }
        }

        // 2. Fluxo Socialite tradicional (se vier com code via GET)
        if (empty($email) && $request->has('code')) {
            try {
                $googleUser = Socialite::driver('google')->user();
                $email = strtolower(trim((string) $googleUser->getEmail()));
                $name  = $googleUser->getName();
            } catch (\Throwable $e) {
                Log::error('Erro Google OAuth Socialite: ' . $e->getMessage());
            }
        }

        if (empty($email)) {
            return redirect()->to('/admin/login')
                ->with('error', 'Não foi possível autenticar com o Google. Tente novamente.');
        }

        // 3. Busca o usuário na base do ERP (sincronizada com o ZenyDesk-O.S.)
        $user = User::whereRaw('LOWER(email) = ?', [$email])->first();

        if (! $user) {
            return redirect()->to('/admin/login')
                ->with('error', "O e-mail {$email} não possui acesso cadastrado no ERP. Solicite liberação ao administrador.");
        }

        if (! $user->is_active) {
            return redirect()->to('/admin/login')
                ->with('error', 'Sua conta de usuário encontra-se desativada no sistema.');
        }

        if (empty($user->name) && ! empty($name)) {
            $user->name = $name;
            $user->save();
        }

        // Realiza o login oficial do Filament com sessão duradoura
        Auth::login($user, true);

        return redirect()->intended('/admin');
    }
}
