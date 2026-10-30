@extends('help.layout')

@section('title', 'Serviços Especializados - ZENYDESK.ERP')

@section('content')
<div class="space-y-6">

    <!-- Hero Card -->
    <div class="p-8 rounded-3xl glass-card border-blue-500/30 relative overflow-hidden shadow-2xl">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-semibold uppercase tracking-wider mb-4">
            Customização Sob Medida
        </div>
        <h1 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight leading-tight">
            Serviços Especializados & Desenvolvimento Personalizado
        </h1>
        <p class="mt-3 text-sm sm:text-base text-slate-400 leading-relaxed max-w-3xl">
            Sua empresa tem processos exclusivos? Nossa equipe de engenharia desenvolve integrações, campos sob medida, relatórios executivos e rotinas automatizadas que se adaptam exatamente ao seu fluxo.
        </p>
    </div>

    <!-- Catálogo de Serviços Pagos -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div class="p-6 rounded-2xl glass-card space-y-3">
            <div class="w-10 h-10 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/></svg>
            </div>
            <h3 class="text-base font-bold text-white">Migração de Dados Legados</h3>
            <p class="text-xs text-slate-400 leading-relaxed">
                Importamos seus cadastros históricos de clientes, fornecedores, produtos e movimentações a partir de planilhas Excel, arquivos CSV ou outros ERPs, sem perda de histórico.
            </p>
        </div>

        <div class="p-6 rounded-2xl glass-card space-y-3">
            <div class="w-10 h-10 rounded-xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center text-purple-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/></svg>
            </div>
            <h3 class="text-base font-bold text-white">Módulos Exclusivos & Plugins</h3>
            <p class="text-xs text-slate-400 leading-relaxed">
                Desenvolvemos módulos complementares dedicados para regras específicas do seu segmento (indústria têxtil, locação de equipamentos, transportadoras, etc.).
            </p>
        </div>

        <div class="p-6 rounded-2xl glass-card space-y-3">
            <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
            </div>
            <h3 class="text-base font-bold text-white">Integrações de APIs & Gateways</h3>
            <p class="text-xs text-slate-400 leading-relaxed">
                Conectamos seu ZENYDESK.ERP a marketplaces, e-commerces (WooCommerce, Shopify), gateways de pagamento adicionais e plataformas de logística.
            </p>
        </div>

        <div class="p-6 rounded-2xl glass-card space-y-3">
            <div class="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            </div>
            <h3 class="text-base font-bold text-white">Relatórios & Dashboards Personalizados</h3>
            <p class="text-xs text-slate-400 leading-relaxed">
                Criação de visões gerenciais executivas, relatórios DRE customizados e exportações em múltiplos formatos com a identidade visual da sua marca.
            </p>
        </div>

    </div>

    <!-- Solicitar Proposta -->
    <div class="p-6 sm:p-8 rounded-2xl glass-card border-blue-500/30 flex flex-col sm:flex-row items-center justify-between gap-6">
        <div>
            <h3 class="text-lg font-bold text-white">Deseja uma estimativa para sua empresa?</h3>
            <p class="text-xs text-slate-400 mt-1">Converse com nossos especialistas de arquitetura e receba um plano de desenvolvimento sob medida.</p>
        </div>
        <a href="https://wa.me/557598626311?text=Ol%C3%A1!%20Gostaria%20de%20receber%20uma%20estimativa%20para%20minha%20empresa%20sobre%20os%20servi%C3%A7os%20e%20desenvolvimento%20sob%20medida%20no%20ZenyDesk%20ERP."
           target="_blank" rel="noopener noreferrer"
           class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs sm:text-sm transition shadow-lg shadow-blue-600/30 whitespace-nowrap">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.311.045-.698.059-2.023-.489-1.614-.667-2.656-2.31-2.736-2.417-.08-.107-.655-.873-.655-1.664 0-.791.41-1.18.556-1.341.146-.16.32-.2.427-.2.107 0 .213.002.307.006.1.005.234-.038.366.279.136.328.465 1.134.505 1.216.04.082.066.179.013.286-.053.107-.08.173-.16.267-.08.093-.167.208-.239.279-.08.08-.163.167-.07.327.093.16.413.682.886 1.103.608.542 1.121.71 1.281.79.16.08.253.067.347-.04.093-.107.4-.467.507-.627.107-.16.213-.133.36-.08.147.053.933.44 1.093.52.16.08.267.12.307.187.04.066.04.385-.104.79zM12 2C6.477 2 2 6.477 2 12c0 1.891.524 3.66 1.436 5.176L2 22l4.982-1.306A9.957 9.957 0 0012 22c5.523 0 10-4.477 10-10S17.523 2 12 2z"/></svg>
            <span>Solicitar Proposta Especializada</span>
        </a>
    </div>

</div>
@endsection
