<div class="mt-4 pt-3 border-t border-gray-200 dark:border-gray-800">
    @if(session('error'))
        <div class="mb-3 p-3 bg-red-50 dark:bg-red-950/40 border border-red-200 dark:border-red-900 rounded-lg text-xs text-red-600 dark:text-red-400 text-center font-medium">
            {{ session('error') }}
        </div>
    @endif

    <div class="relative flex py-2 items-center">
        <div class="flex-grow border-t border-gray-300 dark:border-gray-700"></div>
        <span class="flex-shrink mx-3 text-xs uppercase tracking-wider font-semibold text-gray-500 dark:text-gray-400">ou</span>
        <div class="flex-grow border-t border-gray-300 dark:border-gray-700"></div>
    </div>

    <!-- Script Oficial do Google Identity Services -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>

    <!-- Formulário invisível para submeter o JWT ao backend com CSRF -->
    <form id="google-login-form" action="{{ route('auth.google.callback') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="credential" id="google-credential-input">
    </form>

    <div id="g_id_onload"
         data-client_id="{{ config('services.google.client_id', '615444982313-dvtl6p7jtb7smte977430comtvu118ge.apps.googleusercontent.com') }}"
         data-callback="handleGoogleLoginCallback"
         data-auto_prompt="false">
    </div>

    <div class="mt-2 flex justify-center">
        <div class="g_id_signin w-full flex justify-center"
             data-type="standard"
             data-size="large"
             data-theme="outline"
             data-text="sign_in_with"
             data-shape="rectangular"
             data-logo_alignment="left"
             data-width="320"
             data-locale="pt-BR">
        </div>
    </div>

    <script>
        function handleGoogleLoginCallback(response) {
            if (response && response.credential) {
                var credInput = document.getElementById('google-credential-input');
                var loginForm = document.getElementById('google-login-form');
                if (credInput && loginForm) {
                    credInput.value = response.credential;
                    loginForm.submit();
                }
            }
        }
    </script>
</div>
