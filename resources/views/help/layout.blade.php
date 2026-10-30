<!DOCTYPE html>
<html lang="pt-BR" class="h-full bg-[#0b0f19] text-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Central de Documentação ZENYDESK.ERP</title>
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico?v=2">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32.png?v=2">
    <link rel="apple-touch-icon" href="/images/z-erp-icon.png?v=2">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #0b0f19;
            background-image: 
                radial-gradient(at 0% 0%, rgba(37, 99, 235, 0.1) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(30, 64, 175, 0.08) 0px, transparent 50%);
            background-attachment: fixed;
        }
        .glass-card {
            background: rgba(17, 24, 39, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.07);
        }
    </style>
</head>
<body class="min-h-full flex flex-col font-sans antialiased selection:bg-blue-600 selection:text-white">

    <!-- Top Header -->
    <header class="border-b border-slate-800/80 bg-[#0b0f19]/90 backdrop-blur sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="/admin/help" class="flex flex-col items-start group">
                    <img src="/images/zenydesk-erp-logo.png?v=1" alt="ZENYDESK.ERP" class="h-7 sm:h-8 w-auto object-contain transition group-hover:opacity-90">
                    <span class="text-[9px] sm:text-[10px] uppercase tracking-[0.25em] text-slate-400 font-bold mt-1 pl-0.5">CENTRAL DE AJUDA</span>
                </a>
            </div>
            <div class="flex items-center gap-3">
                <a href="/admin/help" class="px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-300 hover:text-white transition font-medium text-xs sm:text-sm border border-slate-700/80 flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    <span>Voltar à Central</span>
                </a>
                <a href="/admin" class="px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-white transition font-semibold text-xs sm:text-sm flex items-center gap-2 shadow-lg shadow-blue-600/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Painel ERP</span>
                </a>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full flex-1">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <!-- Sidebar de Navegação de Guias -->
            <aside class="lg:col-span-3 space-y-6">
                <div class="p-5 rounded-2xl glass-card space-y-4 shadow-xl">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block px-2">Documentação Oficial</span>

                    <nav class="space-y-1.5 text-xs font-semibold">
                        <a href="/admin/help/cloud-hosting"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ $activeDoc === 'cloud' ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-900/60' }}">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 00-9.78 2.096A4.001 4.001 0 003 15z"/></svg>
                            <span>Hospedagem em Nuvem</span>
                        </a>

                        <a href="/admin/help/support-maintenance"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ $activeDoc === 'support' ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-900/60' }}">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            <span>Suporte e Manutenção</span>
                        </a>

                        <a href="/admin/help/custom-services"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ $activeDoc === 'services' ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-900/60' }}">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                            <span>Serviços Especializados</span>
                        </a>

                        <a href="/admin/help/modules"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ $activeDoc === 'modules' ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-900/60' }}">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            <span>Catálogo de Módulos</span>
                        </a>

                        <a href="/admin/help/dev-docs"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ $activeDoc === 'dev' ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-900/60' }}">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                            <span>Documentação Dev</span>
                        </a>

                        <a href="/admin/help/user-guide"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ $activeDoc === 'guide' ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-900/60' }}">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            <span>Guia do Usuário</span>
                        </a>
                    </nav>
                </div>

                <!-- Card de Suporte Imediato -->
                <div class="p-5 rounded-2xl glass-card border-blue-500/20 space-y-3 shadow-xl">
                    <span class="text-xs font-bold text-white flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        <span>Precisa de Ajuda Humana?</span>
                    </span>
                    <p class="text-[11px] text-slate-400 leading-relaxed">
                        Nossa equipe técnica atende diretamente no Brasil de segunda a sexta das 08h às 17:30h.
                    </p>
                    <a href="https://zenydesk.com/assist?chat=zerp" onclick="if(window.openZerpChat){window.openZerpChat();return false;}" target="_blank"
                       class="block text-center w-full py-2 px-3 rounded-xl bg-blue-600/15 border border-blue-500/30 text-blue-400 hover:bg-blue-600/25 transition text-xs font-bold">
                        Acessar Central de Atendimento
                    </a>
                </div>
            </aside>

            <!-- Conteúdo Principal do Guia -->
            <main class="lg:col-span-9 space-y-6">
                @yield('content')
            </main>

        </div>
    </div>

    <!-- Footer Corporativo -->
    <footer class="border-t border-slate-800/80 bg-[#0b0f19] py-8 text-center text-xs text-slate-500 mt-12">
        <div class="max-w-7xl mx-auto px-4 space-y-2">
            <p>© 2026-2027 ZENYDESK. Todos os direitos reservados. Ecossistema Multi-Tenant Seguro.</p>
            <p class="text-[11px] text-slate-600">Manual técnico oficial ZENYDESK.ERP.</p>
        </div>
    </footer>

@include('filament.components.zerp-chat-widget')
</body>
</html>
