@extends('help.layout')

@section('title', 'Catálogo de Módulos - ZENYDESK.ERP')

@section('content')
<div class="space-y-6">

    <!-- Hero Card -->
    <div class="p-8 rounded-3xl glass-card border-blue-500/30 relative overflow-hidden shadow-2xl">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-semibold uppercase tracking-wider mb-4">
            Estrutura Modular Flexível
        </div>
        <h1 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight leading-tight">
            Catálogo Oficial de Módulos ZENYDESK.ERP
        </h1>
        <p class="mt-3 text-sm sm:text-base text-slate-400 leading-relaxed max-w-3xl">
            Cada módulo adiciona recursos de ponta ao seu painel administrativo. Você pode ativar ou desativar módulos sob demanda conforme sua empresa cresce, pagando apenas pelo que usa.
        </p>
    </div>

    <!-- Tabela / Cards de Módulos -->
    <div class="space-y-4">

        <!-- Núcleo Base -->
        <div class="p-6 rounded-2xl glass-card border-blue-500/40 relative">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <span class="text-lg font-bold text-white">Núcleo Base (Plano Inicial)</span>
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-500/15 text-emerald-400 border border-emerald-500/20 uppercase">Incluso</span>
                    </div>
                    <p class="text-xs text-slate-400">
                        Clientes, Fornecedores, Catálogo de Produtos e Serviços, Gestão Básica de Estoque, Vendas, Faturamento e Subdomínio Exclusivo.
                    </p>
                </div>
                <div class="text-right shrink-0">
                    <span class="text-xl font-extrabold text-white">R$ 79,90</span>
                    <span class="text-[10px] text-slate-400 block">mensal</span>
                </div>
            </div>
        </div>

        <!-- Módulo 1: Contabilidade -->
        <div class="p-6 rounded-2xl glass-card space-y-2">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <span class="text-base font-bold text-white">Contabilidade Plena</span>
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-500/15 text-blue-400 border border-blue-500/20 uppercase">Add-on</span>
                    </div>
                    <p class="text-xs text-slate-400">
                        Plano de Contas multinível, Livro Diário, Razão, Balancete de Verificação, DFC e Balanço Patrimonial automatizado para contadores.
                    </p>
                </div>
                <div class="text-right shrink-0">
                    <span class="text-lg font-bold text-blue-400">+ R$ 49,90</span>
                    <span class="text-[10px] text-slate-400 block">mensal</span>
                </div>
            </div>
        </div>

        <!-- Módulo 2: RH e Folha -->
        <div class="p-6 rounded-2xl glass-card space-y-2">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <span class="text-base font-bold text-white">Recursos Humanos & Gestão de Colaboradores</span>
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-500/15 text-blue-400 border border-blue-500/20 uppercase">Add-on</span>
                    </div>
                    <p class="text-xs text-slate-400">
                        Cadastro de Colaboradores CLT/PJ, Cargos, Departamentos, Férias, Histórico Salarial e Organograma visual da equipe.
                    </p>
                </div>
                <div class="text-right shrink-0">
                    <span class="text-lg font-bold text-blue-400">+ R$ 39,90</span>
                    <span class="text-[10px] text-slate-400 block">mensal</span>
                </div>
            </div>
        </div>

        <!-- Módulo 3: PDV -->
        <div class="p-6 rounded-2xl glass-card space-y-2">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <span class="text-base font-bold text-white">Frente de Caixa (PDV Ágil)</span>
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-500/15 text-blue-400 border border-blue-500/20 uppercase">Add-on</span>
                    </div>
                    <p class="text-xs text-slate-400">
                        Interface de vendas balcão ultra-rápida, leitor de código de barras, controle de sangria, suprimento e emissão de recibos térmicos.
                    </p>
                </div>
                <div class="text-right shrink-0">
                    <span class="text-lg font-bold text-blue-400">+ R$ 34,90</span>
                    <span class="text-[10px] text-slate-400 block">mensal</span>
                </div>
            </div>
        </div>

        <!-- Módulo 4: Compras -->
        <div class="p-6 rounded-2xl glass-card space-y-2">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <span class="text-base font-bold text-white">Compras & Cotações Estruturadas</span>
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-500/15 text-blue-400 border border-blue-500/20 uppercase">Add-on</span>
                    </div>
                    <p class="text-xs text-slate-400">
                        Ordens de compra formalizadas, cotações comparativas de preços com fornecedores e entrada automática no estoque financeiro.
                    </p>
                </div>
                <div class="text-right shrink-0">
                    <span class="text-lg font-bold text-blue-400">+ R$ 29,90</span>
                    <span class="text-[10px] text-slate-400 block">mensal</span>
                </div>
            </div>
        </div>

        <!-- Módulo 5: Projetos -->
        <div class="p-6 rounded-2xl glass-card space-y-2">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <span class="text-base font-bold text-white">Gestão de Projetos & Quadro Kanban</span>
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-500/15 text-blue-400 border border-blue-500/20 uppercase">Add-on</span>
                    </div>
                    <p class="text-xs text-slate-400">
                        Gerenciamento visual de projetos, tarefas, prazos, marcos e produtividade de cada membro da equipe com cartões interativos.
                    </p>
                </div>
                <div class="text-right shrink-0">
                    <span class="text-lg font-bold text-blue-400">+ R$ 24,90</span>
                    <span class="text-[10px] text-slate-400 block">mensal</span>
                </div>
            </div>
        </div>

        <!-- Módulo 6: Produção BOM -->
        <div class="p-6 rounded-2xl glass-card space-y-2">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <span class="text-base font-bold text-white">Manutenção Industrial & Produção (BOM)</span>
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-500/15 text-blue-400 border border-blue-500/20 uppercase">Add-on</span>
                    </div>
                    <p class="text-xs text-slate-400">
                        Estrutura de materiais (Lista de Componentes / BOM), Ordens de Produção (OP), controle de perdas e formação de custo fabril.
                    </p>
                </div>
                <div class="text-right shrink-0">
                    <span class="text-lg font-bold text-blue-400">+ R$ 49,90</span>
                    <span class="text-[10px] text-slate-400 block">mensal</span>
                </div>
            </div>
        </div>

    </div>

    <!-- Destaque Combo -->
    <div class="p-6 sm:p-8 rounded-2xl bg-gradient-to-r from-blue-950/60 to-slate-900 border border-blue-500/40 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-xl">
        <div>
            <h3 class="text-lg font-bold text-white">Prefere todos os módulos liberados?</h3>
            <p class="text-xs text-slate-400 mt-1">O <strong>Combo All-Inclusive</strong> libera todos os 6 módulos adicionais por <strong>R$ 189,90 / mês</strong> (economia superior a 35%).</p>
        </div>
        <a href="/assinar"
           class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs sm:text-sm transition shadow-lg shadow-blue-600/30 whitespace-nowrap">
            Montar Plano na Calculadora
        </a>
    </div>

</div>
@endsection
