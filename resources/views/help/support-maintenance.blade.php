@extends('help.layout')

@section('title', 'Suporte Técnico e Manutenção - ZENYDESK.ERP')

@section('content')
<div class="space-y-6">

    <!-- Hero Card -->
    <div class="p-8 rounded-3xl glass-card border-blue-500/30 relative overflow-hidden shadow-2xl">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-semibold uppercase tracking-wider mb-4">
            Atendimento Especializado no Brasil
        </div>
        <h1 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight leading-tight">
            Suporte Técnico Dedicado & Manutenção Contínua
        </h1>
        <p class="mt-3 text-sm sm:text-base text-slate-400 leading-relaxed max-w-3xl">
            Sua empresa conta com retaguarda técnica permanente para tirar dúvidas operacionais, receber atualizações preventivas de segurança e garantir estabilidade ininterrupta em todos os módulos.
        </p>
    </div>

    <!-- Nossos Serviços de Suporte -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div class="p-6 rounded-2xl glass-card space-y-3">
            <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg>
            </div>
            <h3 class="text-base font-bold text-white">Canal Direto de WhatsApp & Chamados</h3>
            <p class="text-xs text-slate-400 leading-relaxed">
                Comunicação rápida e humanizada diretamente com engenheiros de software e especialistas de produto, sem filas intermináveis ou bots engessados.
            </p>
        </div>

        <div class="p-6 rounded-2xl glass-card space-y-3">
            <div class="w-10 h-10 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <h3 class="text-base font-bold text-white">Manutenção Preventiva de Segurança</h3>
            <p class="text-xs text-slate-400 leading-relaxed">
                Auditorias regulares de pacotes, aplicação de patches do framework Laravel e do banco MariaDB, blindando seu ERP contra vulnerabilidades de rede.
            </p>
        </div>

        <div class="p-6 rounded-2xl glass-card space-y-3">
            <div class="w-10 h-10 rounded-xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center text-purple-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <h3 class="text-base font-bold text-white">SLA de Atendimento Prioritário</h3>
            <p class="text-xs text-slate-400 leading-relaxed">
                Tempo de resposta rápido: dúvidas operacionais em até 2 horas úteis e incidentes de alta prioridade com tratamento imediato e monitoramento ativo.
            </p>
        </div>

        <div class="p-6 rounded-2xl glass-card space-y-3">
            <div class="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
            </div>
            <h3 class="text-base font-bold text-white">Restauração & Contingência</h3>
            <p class="text-xs text-slate-400 leading-relaxed">
                Caso ocorra qualquer erro acidental de lançamento ou perda de arquivo pela sua equipe, recuperamos o estado dos seus dados a partir dos pontos de restauração.
            </p>
        </div>

    </div>

    <!-- Contato de Suporte -->
    <div class="p-6 sm:p-8 rounded-2xl glass-card border-blue-500/30 flex flex-col sm:flex-row items-center justify-between gap-6">
        <div>
            <h3 class="text-lg font-bold text-white">Precisa de suporte agora?</h3>
            <p class="text-xs text-slate-400 mt-1">Nossa equipe técnica atende diretamente no Brasil de segunda a sexta das 08h às 17:30h.</p>
        </div>
        <a href="https://zenydesk.com/assist?chat=zerp" target="_blank"
           class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs sm:text-sm transition shadow-lg shadow-blue-600/30 whitespace-nowrap">
            Falar com o Suporte ZenyDesk
        </a>
    </div>

</div>
@endsection
