@extends('help.layout')

@section('title', 'Documentação Dev e API - ZENYDESK.ERP')

@section('content')
<div class="space-y-6">

    <!-- Hero Card -->
    <div class="p-8 rounded-3xl glass-card border-blue-500/30 relative overflow-hidden shadow-2xl">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-semibold uppercase tracking-wider mb-4">
            Arquitetura Técnica & Extensibilidade
        </div>
        <h1 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight leading-tight">
            Guia do Desenvolvedor & APIs REST
        </h1>
        <p class="mt-3 text-sm sm:text-base text-slate-400 leading-relaxed max-w-3xl">
            Documentação técnica abrangente para desenvolvedores que desejam integrar sistemas externos, automatizar rotinas via API REST, criar novos plugins modulares e consultar o banco de dados.
        </p>
    </div>

    <!-- Stack Tecnológico Oficial -->
    <div class="p-6 rounded-2xl glass-card space-y-4">
        <h2 class="text-lg font-bold text-white flex items-center gap-2">
            <span>Stack Tecnológico Oficial do ZENYDESK.ERP</span>
        </h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
            <div class="p-3.5 rounded-xl bg-slate-900/60 border border-slate-800">
                <span class="text-slate-400 block text-[11px]">Linguagem</span>
                <span class="text-white font-bold text-sm">PHP 8.3+</span>
            </div>
            <div class="p-3.5 rounded-xl bg-slate-900/60 border border-slate-800">
                <span class="text-slate-400 block text-[11px]">Framework</span>
                <span class="text-white font-bold text-sm">Laravel 11</span>
            </div>
            <div class="p-3.5 rounded-xl bg-slate-900/60 border border-slate-800">
                <span class="text-slate-400 block text-[11px]">Interface / Admin</span>
                <span class="text-white font-bold text-sm">Filament v3</span>
            </div>
            <div class="p-3.5 rounded-xl bg-slate-900/60 border border-slate-800">
                <span class="text-slate-400 block text-[11px]">Banco Relacional</span>
                <span class="text-white font-bold text-sm">MariaDB 10.11</span>
            </div>
        </div>
    </div>

    <!-- Autenticação de API REST -->
    <div class="p-6 rounded-2xl glass-card space-y-4">
        <h2 class="text-lg font-bold text-white">1. Autenticação na API REST (Sanctum Tokens)</h2>
        <p class="text-xs text-slate-400 leading-relaxed">
            Todas as rotas de API do ZENYDESK.ERP utilizam autenticação Bearer Token. Cada requisição deve enviar o cabeçalho <code class="text-blue-400">Authorization: Bearer {SEU_TOKEN}</code>.
        </p>
        <div class="p-4 rounded-xl bg-slate-950 border border-slate-800 font-mono text-xs text-slate-300 overflow-x-auto space-y-2">
            <div class="text-slate-500">// Exemplo de chamada cURL para listar produtos:</div>
            <div>curl -X GET "https://suaempresa.erp.zenydesk.com/api/v1/products" \</div>
            <div class="pl-4">-H "Authorization: Bearer zeny_token_xxxxxxxx" \</div>
            <div class="pl-4">-H "Accept: application/json"</div>
        </div>
    </div>

    <!-- Estrutura de Multi-Tenancy -->
    <div class="p-6 rounded-2xl glass-card space-y-4">
        <h2 class="text-lg font-bold text-white">2. Arquitetura Multi-Tenant & Escopos</h2>
        <p class="text-xs text-slate-400 leading-relaxed">
            O isolamento operacional de empresas utiliza o <code class="text-blue-400">CompanyScope</code>. Sempre que uma consulta Eloquent é executada dentro do contexto de um tenant, ela recebe automaticamente o filtro:
        </p>
        <div class="p-4 rounded-xl bg-slate-950 border border-slate-800 font-mono text-xs text-slate-300 overflow-x-auto">
            <span class="text-purple-400">where</span>(<span class="text-emerald-400">'company_id'</span>, <span class="text-blue-400">$activeCompanyId</span>);
        </div>
        <p class="text-xs text-slate-400 leading-relaxed">
            Isso impede qualquer vazamento de dados entre diferentes empresas assinantes que compartilham o mesmo servidor.
        </p>
    </div>

    <!-- Criação de Plugins / Extensões -->
    <div class="p-6 rounded-2xl glass-card space-y-4">
        <h2 class="text-lg font-bold text-white">3. Criação de Extensões Modulares</h2>
        <p class="text-xs text-slate-400 leading-relaxed">
            Cada recurso do ZENYDESK.ERP reside dentro do diretório <code class="text-blue-400">/plugins/webkul/{nome-do-modulo}/</code> contendo seu próprio provedor de serviços (<code class="text-slate-300">PluginServiceProvider.php</code>), migrações de banco, rotas e recursos Filament.
        </p>
    </div>

</div>
@endsection
