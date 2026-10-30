<!DOCTYPE html>
<html lang="pt-BR" class="h-full bg-[#0b0f19] text-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assine o ZENYDESK.ERP | Plataforma de Gestão Empresarial Multi-Tenant</title>
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico?v=2">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32.png?v=2">
    <link rel="apple-touch-icon" href="/images/z-erp-icon.png?v=2">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        zeny: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                            dark: '#0b0f19',
                            card: '#111827',
                            border: '#1f2937'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #0b0f19;
            background-image: 
                radial-gradient(at 0% 0%, rgba(37, 99, 235, 0.12) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(30, 64, 175, 0.08) 0px, transparent 50%),
                radial-gradient(at 50% 100%, rgba(37, 99, 235, 0.05) 0px, transparent 50%);
            background-attachment: fixed;
        }
        .glass-card {
            background: rgba(17, 24, 39, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.07);
        }
        .glass-card-hover:hover {
            border-color: rgba(59, 130, 246, 0.4);
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.15);
        }
        .btn-gradient {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-gradient:hover {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            box-shadow: 0 12px 24px -6px rgba(37, 99, 235, 0.4);
        }
    </style>
</head>
<body class="min-h-full flex flex-col font-sans antialiased selection:bg-blue-600 selection:text-white">

    <!-- Top Notification Bar -->
    <div class="bg-gradient-to-r from-blue-950/60 via-blue-900/40 to-blue-950/60 border-b border-blue-500/20 py-2 px-4 text-center text-xs text-blue-300 font-medium flex items-center justify-center gap-2">
        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
        <span>Infraestrutura Própria Dedicada no Brasil • Provisionamento Instantâneo com Subdomínio Próprio</span>
    </div>

    <!-- Header Corporativo -->
    <header class="border-b border-slate-800/80 bg-[#0b0f19]/80 backdrop-blur-md sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="/" class="flex flex-col items-start group">
                    <img src="/images/zenydesk-erp-logo.png?v=1" alt="ZENYDESK.ERP" class="h-7 sm:h-8 w-auto object-contain transition group-hover:opacity-90">
                    <span class="text-[9px] sm:text-[10px] uppercase tracking-[0.25em] text-slate-400 font-bold mt-1 pl-0.5">GESTÃO EMPRESARIAL</span>
                </a>
            </div>
            <div class="flex items-center gap-3 sm:gap-4 text-sm">
                <span class="text-slate-400 text-xs sm:text-sm hidden md:inline">Já possui um ambiente contratado?</span>
                <a href="/admin/login" class="px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-200 hover:text-white transition font-semibold text-xs sm:text-sm border border-slate-700/80 flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                    <span>Entrar no Painel</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="pt-12 pb-8 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto text-center">
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-semibold uppercase tracking-wider mb-4">
            <svg class="w-3.5 h-3.5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            <span>Arquitetura Multi-Tenant Modular • 2026 / 2027</span>
        </div>
        <h1 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight leading-tight">
            Seu ERP Completo Sob Medida,<br class="hidden sm:inline">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-blue-500 to-indigo-400">
                Sem Pagar por Módulos que Não Usa
            </span>
        </h1>
        <p class="mt-4 text-base sm:text-lg text-slate-400 max-w-2xl mx-auto leading-relaxed">
            Escolha o endereço exclusivo da sua empresa, ative apenas os módulos operacionais necessários e tenha seu ambiente liberado no mesmo segundo da confirmação.
        </p>
    </section>

    <!-- Conteúdo Principal: Onboarding & Calculadora -->
    <main class="flex-1 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 w-full">

        <form id="form-onboarding" class="space-y-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                <!-- Coluna Esquerda: Subdomínio, Dados da Empresa e Pagamento (7 colunas) -->
                <div class="lg:col-span-7 space-y-6">

                    <!-- Bloco 1: Subdomínio Exclusivo -->
                    <div class="p-6 sm:p-7 rounded-2xl glass-card shadow-2xl relative overflow-hidden">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-8 h-8 rounded-lg bg-blue-500/15 border border-blue-500/30 flex items-center justify-center text-blue-400 font-bold text-sm">
                                1
                            </div>
                            <h2 class="text-lg font-bold text-white tracking-tight">
                                Escolha o seu Subdomínio Exclusivo
                            </h2>
                        </div>
                        <p class="text-xs text-slate-400 mb-5 pl-11">
                            Este será o link oficial e permanente para você e seus funcionários acessarem o sistema.
                        </p>

                        <div class="space-y-2">
                            <label class="block text-xs font-semibold text-slate-300">Endereço Web Desejado</label>
                            <div class="flex rounded-xl shadow-sm overflow-hidden border border-slate-700/80 focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-500/20 transition">
                                <span class="inline-flex items-center px-3.5 bg-slate-900 text-slate-400 text-xs sm:text-sm font-mono border-r border-slate-700/80">
                                    https://
                                </span>
                                <input type="text" id="subdominio" name="subdominio" required
                                       placeholder="minhaempresa"
                                       class="flex-1 min-w-0 block w-full px-3.5 py-3 bg-[#0b0f19] text-white text-sm font-bold focus:outline-none placeholder-slate-600">
                                <span class="inline-flex items-center px-3.5 bg-slate-900 text-slate-300 text-xs sm:text-sm font-mono font-bold border-l border-slate-700/80 text-blue-400">
                                    .erp.zenydesk.com
                                </span>
                            </div>
                            <div id="subdomain-feedback" class="mt-2 text-xs font-medium flex items-center gap-1.5 hidden"></div>
                        </div>
                    </div>

                    <!-- Bloco 2: Dados Cadastrais -->
                    <div class="p-6 sm:p-7 rounded-2xl glass-card shadow-2xl space-y-4">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-8 h-8 rounded-lg bg-blue-500/15 border border-blue-500/30 flex items-center justify-center text-blue-400 font-bold text-sm">
                                2
                            </div>
                            <h2 class="text-lg font-bold text-white tracking-tight">
                                Dados Cadastrais da Empresa & Acesso Mestre
                            </h2>
                        </div>
                        <p class="text-xs text-slate-400 mb-4 pl-11">
                            O e-mail e a senha digitados serão o usuário Administrador com permissão plena para gerenciar seu ERP.
                        </p>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-1.5">Nome da Empresa / Razão Social *</label>
                                <input type="text" name="nome_empresa" required placeholder="Ex: Comercial Oliveira Ltda"
                                       class="w-full px-3.5 py-2.5 bg-[#0b0f19] border border-slate-700/80 rounded-xl text-white text-sm focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 focus:outline-none transition">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-1.5">CNPJ ou CPF do Titular *</label>
                                <input type="text" id="cpf_cnpj" name="cpf_cnpj" required placeholder="00.000.000/0000-00"
                                       class="w-full px-3.5 py-2.5 bg-[#0b0f19] border border-slate-700/80 rounded-xl text-white text-sm focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 focus:outline-none transition">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-1.5">Nome do Responsável *</label>
                                <input type="text" name="responsavel" required placeholder="Nome e Sobrenome"
                                       class="w-full px-3.5 py-2.5 bg-[#0b0f19] border border-slate-700/80 rounded-xl text-white text-sm focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 focus:outline-none transition">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-1.5">Telefone / WhatsApp *</label>
                                <input type="text" id="telefone" name="telefone" required placeholder="Digite aqui seu número"
                                       class="w-full px-3.5 py-2.5 bg-[#0b0f19] border border-slate-700/80 rounded-xl text-white text-sm focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 focus:outline-none transition">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1">
                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-1.5">E-mail Principal (Login) *</label>
                                <input type="email" name="email" required placeholder="admin@suaempresa.com"
                                       class="w-full px-3.5 py-2.5 bg-[#0b0f19] border border-slate-700/80 rounded-xl text-white text-sm focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 focus:outline-none transition">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-1.5">Senha de Acesso Administrador *</label>
                                <input type="password" name="senha" required placeholder="Mínimo de 6 caracteres"
                                       class="w-full px-3.5 py-2.5 bg-[#0b0f19] border border-slate-700/80 rounded-xl text-white text-sm focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 focus:outline-none transition">
                            </div>
                        </div>
                    </div>

                    <!-- Bloco 3: Forma de Pagamento -->
                    <div class="p-6 sm:p-7 rounded-2xl glass-card shadow-2xl space-y-4">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-8 h-8 rounded-lg bg-blue-500/15 border border-blue-500/30 flex items-center justify-center text-blue-400 font-bold text-sm">
                                3
                            </div>
                            <h2 class="text-lg font-bold text-white tracking-tight">
                                Escolha a Forma de Pagamento
                            </h2>
                        </div>
                        <p class="text-xs text-slate-400 mb-4 pl-11">
                            Pagamentos processados com segurança bancária direta via Asaas.
                        </p>

                        <!-- Botões de Alternância PIX / Cartão -->
                        <div class="grid grid-cols-2 gap-3">
                            <button type="button" id="btn-tab-pix" onclick="setPaymentMethod('PIX')"
                                    class="py-3 px-4 rounded-xl border text-center font-bold text-xs sm:text-sm transition flex items-center justify-center gap-2.5 border-blue-500 bg-blue-500/15 text-blue-400 shadow-sm">
                                <img src="/images/icon-pix-symbol.png?v=1" alt="PIX" class="w-5 h-5 object-contain">
                                <span>PIX Instantâneo</span>
                            </button>
                            <button type="button" id="btn-tab-card" onclick="setPaymentMethod('CREDIT_CARD')"
                                    class="py-3 px-4 rounded-xl border border-slate-700/80 bg-slate-900 text-slate-400 hover:text-white text-center font-bold text-xs sm:text-sm transition flex items-center justify-center gap-2.5">
                                <img src="/images/icon-card-animated.gif?v=2" alt="Cartão" class="w-6 h-6 object-contain rounded">
                                <span>Cartão de Crédito</span>
                            </button>
                        </div>
                        <input type="hidden" name="forma_pagamento" id="forma_pagamento" value="PIX">

                        <!-- Campos Cartão de Crédito -->
                        <div id="card-fields" class="space-y-3 pt-4 border-t border-slate-800 hidden">
                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-1">Número do Cartão</label>
                                <input type="text" name="card_number" id="card_number" placeholder="0000 0000 0000 0000"
                                       class="w-full px-3.5 py-2.5 bg-[#0b0f19] border border-slate-700/80 rounded-xl text-white text-sm focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-1">Nome Impresso no Cartão</label>
                                <input type="text" name="card_holder" placeholder="NOME COMO NO CARTAO"
                                       class="w-full px-3.5 py-2.5 bg-[#0b0f19] border border-slate-700/80 rounded-xl text-white text-sm focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 focus:outline-none uppercase">
                            </div>
                            <div class="grid grid-cols-3 gap-3">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-300 mb-1">Mês (MM)</label>
                                    <input type="text" name="card_expiry_month" placeholder="12" maxlength="2"
                                           class="w-full px-3.5 py-2.5 bg-[#0b0f19] border border-slate-700/80 rounded-xl text-white text-sm focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 focus:outline-none text-center">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-300 mb-1">Ano (AAAA)</label>
                                    <input type="text" name="card_expiry_year" placeholder="2028" maxlength="4"
                                           class="w-full px-3.5 py-2.5 bg-[#0b0f19] border border-slate-700/80 rounded-xl text-white text-sm focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 focus:outline-none text-center">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-300 mb-1">CVV</label>
                                    <input type="text" name="card_cvv" placeholder="123" maxlength="4"
                                           class="w-full px-3.5 py-2.5 bg-[#0b0f19] border border-slate-700/80 rounded-xl text-white text-sm focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 focus:outline-none text-center">
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-300 mb-1">CEP do Titular</label>
                                    <input type="text" name="postal_code" id="postal_code" placeholder="00000-000"
                                           class="w-full px-3.5 py-2.5 bg-[#0b0f19] border border-slate-700/80 rounded-xl text-white text-sm focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 focus:outline-none">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-300 mb-1">Número do Imóvel</label>
                                    <input type="text" name="address_number" placeholder="123"
                                           class="w-full px-3.5 py-2.5 bg-[#0b0f19] border border-slate-700/80 rounded-xl text-white text-sm focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 focus:outline-none">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Coluna Direita: Calculadora Interativa e Resumo (5 colunas) -->
                <div class="lg:col-span-5">
                    <div class="sticky top-28 space-y-6">

                        <div class="p-6 sm:p-7 rounded-2xl glass-card border-blue-500/30 shadow-2xl relative">
                            <div class="flex items-center justify-between pb-4 border-b border-slate-800">
                                <div>
                                    <h3 class="text-lg font-bold text-white tracking-tight">Calculadora do Seu ERP</h3>
                                    <p class="text-xs text-slate-400">Personalize os módulos sob demanda</p>
                                </div>
                                <span class="px-2.5 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-[11px] font-bold">Tabela 2026/2027</span>
                            </div>

                            <!-- Plano Base Incluso -->
                            <div class="py-4 border-b border-slate-800/80">
                                <div class="flex items-start justify-between">
                                    <div class="pr-2">
                                        <div class="flex items-center gap-2">
                                            <span class="font-bold text-white text-sm">Plano Núcleo Base</span>
                                            <span class="text-[10px] uppercase font-bold px-2 py-0.5 rounded-full bg-emerald-500/15 text-emerald-400 border border-emerald-500/20">Incluso</span>
                                        </div>
                                        <p class="text-xs text-slate-400 mt-1 leading-relaxed">
                                            Clientes, Fornecedores, Produtos, Estoque Básico, Vendas e Subdomínio Exclusivo com SSL.
                                        </p>
                                    </div>
                                    <span class="text-sm font-extrabold text-white whitespace-nowrap">R$ 79,90</span>
                                </div>
                            </div>

                            <!-- Opção Combo All-Inclusive com Destaque -->
                            <div class="my-4 p-4 rounded-xl bg-gradient-to-r from-blue-950/60 to-slate-900 border border-blue-500/40 shadow-inner">
                                <label class="flex items-start gap-3 cursor-pointer">
                                    <input type="checkbox" id="check-combo" onchange="toggleCombo(this.checked)"
                                           class="mt-1 w-4 h-4 rounded text-blue-600 bg-slate-950 border-slate-700 focus:ring-blue-500">
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <span class="font-extrabold text-blue-300 text-sm flex items-center gap-1.5">
                                                <span>Combo Empresarial Completo</span>
                                            </span>
                                            <span class="text-sm font-extrabold text-blue-400">R$ 189,90</span>
                                        </div>
                                        <p class="text-[11px] text-slate-400 mt-1">
                                            Libera todos os 6 módulos adicionais com <strong class="text-emerald-400 font-semibold">economia superior a 35%</strong> na mensalidade.
                                        </p>
                                    </div>
                                </label>
                            </div>

                            <!-- Lista de Módulos Individuais -->
                            <div id="container-modulos" class="py-2 space-y-3 border-b border-slate-800/80 text-xs">
                                <span class="font-bold text-slate-400 uppercase tracking-wider text-[11px] block mb-2">Selecione Módulos Individuais:</span>

                                @foreach($modulePrices as $key => $mod)
                                <label class="flex items-start justify-between gap-3 p-2.5 rounded-xl bg-slate-900/60 border border-slate-800 hover:border-slate-700 cursor-pointer transition group">
                                    <div class="flex items-start gap-2.5">
                                        <input type="checkbox" name="modulos[]" value="{{ $key }}" onchange="recalculateTotal()"
                                               class="module-check mt-0.5 w-4 h-4 rounded text-blue-600 bg-slate-950 border-slate-700 focus:ring-blue-500">
                                        <span class="text-slate-300 group-hover:text-white transition font-medium leading-snug">{{ $mod['name'] }}</span>
                                    </div>
                                    <span class="font-bold text-slate-300 whitespace-nowrap text-right">+ R$ {{ number_format($mod['price'], 2, ',', '.') }}</span>
                                </label>
                                @endforeach
                            </div>

                            <!-- Totalizador Final e Botão de Ativação -->
                            <div class="pt-5 space-y-4">
                                <div class="flex items-baseline justify-between">
                                    <span class="text-sm font-semibold text-slate-400">Total Mensalidade:</span>
                                    <div class="text-right">
                                        <div class="text-3xl font-extrabold text-white tracking-tight" id="display-total">R$ 79,90</div>
                                        <span class="text-[11px] text-slate-400">Cobrança recorrente mensal via Asaas</span>
                                    </div>
                                </div>

                                <button type="submit" id="btn-submit"
                                        class="w-full py-4 px-6 rounded-xl btn-gradient text-white font-extrabold text-base shadow-lg shadow-blue-600/30 active:scale-[0.99] transition duration-150 flex items-center justify-center gap-2">
                                    <span>Concluir Cadastro & Ativar ERP</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </button>

                                <div class="flex items-center justify-center gap-4 text-[11px] text-slate-400 pt-2 font-medium">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                        Isolamento Criptográfico
                                    </span>
                                    <span>•</span>
                                    <span>Ativação Instantânea</span>
                                    <span>•</span>
                                    <span>Sem Multa de Fidelidade</span>
                                </div>
                            </div>

                        </div>

                        <!-- Card de Garantia de Infraestrutura -->
                        <div class="p-5 rounded-2xl glass-card border-slate-800 text-xs text-slate-400 space-y-2.5">
                            <div class="flex items-center gap-2 text-white font-bold text-sm">
                                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Garantias Técnicas ZenyDesk</span>
                            </div>
                            <p class="leading-relaxed">
                                Seu banco de dados opera em ambiente isolado no MariaDB corporativo, com backup em nuvem e protocolo TLS 1.3 de ponta a ponta.
                            </p>
                        </div>

                    </div>
                </div>

            </div>
        </form>

    </main>

    <!-- Modal Pix com QR Code e Copia e Cola -->
    <div id="modal-pix" class="fixed inset-0 z-50 bg-[#0b0f19]/90 backdrop-blur-md flex items-center justify-center p-4 hidden">
        <div class="glass-card border-blue-500/40 rounded-3xl max-w-md w-full p-6 sm:p-8 text-center shadow-2xl relative">
            <div class="w-12 h-12 rounded-2xl bg-blue-500/10 border border-blue-500/30 flex items-center justify-center mx-auto mb-3">
                <img src="/images/icon-pix-symbol.png?v=1" alt="PIX" class="w-7 h-7 object-contain">
            </div>
            <h3 class="text-2xl font-extrabold text-white mb-1">Pagamento via PIX</h3>
            <p class="text-xs text-slate-400 mb-5">
                Escaneie o QR Code abaixo no app do seu banco ou copie a chave Pix. Seu ERP será provisionado no mesmo segundo da confirmação!
            </p>

            <div class="bg-white p-4 rounded-2xl inline-block mb-5 shadow-xl">
                <img id="pix-qrcode-img" src="" alt="QR Code Pix" class="w-48 h-48 mx-auto">
            </div>

            <div class="mb-5 text-left">
                <label class="block text-xs font-semibold text-slate-300 mb-1.5">Código Pix Copia e Cola</label>
                <div class="flex gap-2">
                    <input type="text" id="pix-copia-cola" readonly
                           class="w-full text-xs font-mono bg-[#0b0f19] border border-slate-700/80 px-3 py-2.5 rounded-xl text-slate-300 focus:outline-none">
                    <button type="button" onclick="copyPixCode()" id="btn-copy-pix"
                            class="px-4 py-2.5 bg-blue-600 hover:bg-blue-500 text-white rounded-xl text-xs font-bold whitespace-nowrap transition shadow-sm">
                        Copiar
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-center gap-2.5 text-xs text-blue-400 font-semibold animate-pulse">
                <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
                <span>Aguardando liquidação bancária automática...</span>
            </div>
        </div>
    </div>

    <!-- Footer Corporativo -->
    <footer class="border-t border-slate-800/80 bg-[#0b0f19] py-8 text-center text-xs text-slate-500">
        <div class="max-w-7xl mx-auto px-4 space-y-2">
            <p>© 2026-2027 ZENYDESK. Todos os direitos reservados. Ecossistema Multi-Tenant Seguro.</p>
            <p class="text-[11px] text-slate-600">Ambiente de computação dedicado com garantia de isolamento operacional.</p>
        </div>
    </footer>

    <!-- Scripts da Calculadora e Comunicação -->
    <script>
        const BASE_PRICE = {{ $basePrice }};
        const COMBO_PRICE = {{ $comboPrice }};
        const MODULE_PRICES = @json($modulePrices);

        let debounceTimer;
        let pollingTimer;
        const subInput = document.getElementById('subdominio');
        const subFeedback = document.getElementById('subdomain-feedback');

        // Formatação simples para CPF/CNPJ e Telefone
        document.getElementById('cpf_cnpj').addEventListener('input', function(e) {
            let v = e.target.value.replace(/\D/g, '');
            if (v.length <= 11) {
                v = v.replace(/(\d{3})(\d)/, '$1.$2');
                v = v.replace(/(\d{3})(\d)/, '$1.$2');
                v = v.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            } else {
                v = v.substring(0, 14);
                v = v.replace(/^(\d{2})(\d)/, '$1.$2');
                v = v.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
                v = v.replace(/\.(\d{3})(\d)/, '.$1/$2');
                v = v.replace(/(\d{4})(\d)/, '$1-$2');
            }
            e.target.value = v;
        });

        document.getElementById('telefone').addEventListener('input', function(e) {
            let v = e.target.value.replace(/\D/g, '').substring(0, 11);
            v = v.replace(/^(\d{2})(\d)/g, '($1) $2');
            v = v.replace(/(\d)(\d{4})$/, '$1-$2');
            e.target.value = v;
        });

        // Pré-preenche subdomínio se vier por URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('sub')) {
            subInput.value = urlParams.get('sub').toLowerCase().replace(/[^a-z0-9\-]/g, '');
            checkSubdomainAvailability();
        }

        subInput.addEventListener('input', function() {
            this.value = this.value.toLowerCase().replace(/[^a-z0-9\-]/g, '');
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(checkSubdomainAvailability, 400);
        });

        function checkSubdomainAvailability() {
            const val = subInput.value.trim();
            if (val.length < 3) {
                subFeedback.classList.remove('hidden');
                subFeedback.className = 'mt-2 text-xs font-medium text-amber-400 flex items-center gap-1.5';
                subFeedback.textContent = 'O subdomínio precisa ter pelo menos 3 caracteres.';
                return;
            }

            fetch('/assinar/check-subdomain?subdominio=' + encodeURIComponent(val))
                .then(r => r.json())
                .then(data => {
                    subFeedback.classList.remove('hidden');
                    if (data.available) {
                        subFeedback.className = 'mt-2 text-xs font-semibold text-emerald-400 flex items-center gap-1.5';
                        subFeedback.innerHTML = '<svg class="w-4 h-4 text-emerald-400 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Disponível: ' + data.message;
                    } else {
                        subFeedback.className = 'mt-2 text-xs font-semibold text-red-400 flex items-center gap-1.5';
                        subFeedback.textContent = data.message;
                    }
                });
        }

        function toggleCombo(isCombo) {
            const modChecks = document.querySelectorAll('.module-check');
            const container = document.getElementById('container-modulos');

            if (isCombo) {
                container.classList.add('opacity-40', 'pointer-events-none');
                modChecks.forEach(c => c.checked = true);
            } else {
                container.classList.remove('opacity-40', 'pointer-events-none');
                modChecks.forEach(c => c.checked = false);
            }
            recalculateTotal();
        }

        function recalculateTotal() {
            const isCombo = document.getElementById('check-combo').checked;
            let total = isCombo ? COMBO_PRICE : BASE_PRICE;

            if (!isCombo) {
                document.querySelectorAll('.module-check:checked').forEach(cb => {
                    if (MODULE_PRICES[cb.value]) {
                        total += MODULE_PRICES[cb.value].price;
                    }
                });
            }

            document.getElementById('display-total').textContent = 'R$ ' + total.toLocaleString('pt-BR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        function setPaymentMethod(method) {
            document.getElementById('forma_pagamento').value = method;
            const btnPix = document.getElementById('btn-tab-pix');
            const btnCard = document.getElementById('btn-tab-card');
            const cardFields = document.getElementById('card-fields');

            if (method === 'PIX') {
                btnPix.className = 'py-3 px-4 rounded-xl border text-center font-bold text-xs sm:text-sm transition flex items-center justify-center gap-2.5 border-blue-500 bg-blue-500/15 text-blue-400 shadow-sm';
                btnCard.className = 'py-3 px-4 rounded-xl border border-slate-700/80 bg-slate-900 text-slate-400 hover:text-white text-center font-bold text-xs sm:text-sm transition flex items-center justify-center gap-2.5';
                cardFields.classList.add('hidden');
            } else {
                btnCard.className = 'py-3 px-4 rounded-xl border text-center font-bold text-xs sm:text-sm transition flex items-center justify-center gap-2.5 border-blue-500 bg-blue-500/15 text-blue-400 shadow-sm';
                btnPix.className = 'py-3 px-4 rounded-xl border border-slate-700/80 bg-slate-900 text-slate-400 hover:text-white text-center font-bold text-xs sm:text-sm transition flex items-center justify-center gap-2.5';
                cardFields.classList.remove('hidden');
            }
        }

        function copyPixCode() {
            const input = document.getElementById('pix-copia-cola');
            input.select();
            document.execCommand('copy');
            const btn = document.getElementById('btn-copy-pix');
            btn.textContent = 'Copiado!';
            btn.classList.replace('bg-blue-600', 'bg-emerald-600');
            setTimeout(() => {
                btn.textContent = 'Copiar';
                btn.classList.replace('bg-emerald-600', 'bg-blue-600');
            }, 2500);
        }

        // Envio do formulário
        document.getElementById('form-onboarding').addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = document.getElementById('btn-submit');
            btn.disabled = true;
            btn.innerHTML = '<svg class="w-5 h-5 animate-spin mx-auto text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>';

            const formData = new FormData(this);

            fetch('/assinar/checkout', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(r => r.json())
            .then(data => {
                btn.disabled = false;
                btn.innerHTML = '<span>Concluir Cadastro & Ativar ERP</span>';

                if (!data.success) {
                    alert(data.message || 'Erro ao processar assinatura.');
                    return;
                }

                const isPix = (data.payment_method === 'PIX' || data.type === 'PIX');
                const qrImage = qrImage || data.qrCodeImage;
                const copiaCola = copiaCola || data.copiaECola;
                const redirectUrl = data.redirect_url || data.urlDestino || data.redirectUrl;

                if (isPix && qrImage) {
                    document.getElementById('pix-qrcode-img').src = 'data:image/png;base64,' + qrImage;
                    document.getElementById('pix-copia-cola').value = copiaCola || '';
                    document.getElementById('modal-pix').classList.remove('hidden');

                    // Inicia verificação automática periódica
                    startStatusPolling(data.subdominio, redirectUrl);
                } else if (data.redirect_url) {
                    window.location.href = data.redirect_url;
                }
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerHTML = '<span>Concluir Cadastro & Ativar ERP</span>';
                alert('Ocorreu um erro de conexão com o servidor de pagamento. Tente novamente.');
            });
        });

        function startStatusPolling(subdominio, redirectUrl) {
            clearInterval(pollingTimer);
            pollingTimer = setInterval(() => {
                fetch('/assinar/status/' + encodeURIComponent(subdominio))
                    .then(r => r.json())
                    .then(res => {
                        if (res.found && res.status === 'ativo') {
                            clearInterval(pollingTimer);
                            window.location.href = res.redirectUrl || redirectUrl;
                        }
                    });
            }, 3000);
        }
    </script>
</body>
</html>
