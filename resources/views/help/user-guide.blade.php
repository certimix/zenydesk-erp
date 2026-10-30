@extends('help.layout')

@section('title', 'Manual do Usuário - ZENYDESK.ERP')

@section('content')
<div class="space-y-6">

    <!-- Hero Card -->
    <div class="p-8 rounded-3xl glass-card border-blue-500/30 relative overflow-hidden shadow-2xl">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-semibold uppercase tracking-wider mb-4">
            Operação Prática Diária
        </div>
        <h1 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight leading-tight">
            Manual do Usuário & Guia Passo a Passo
        </h1>
        <p class="mt-3 text-sm sm:text-base text-slate-400 leading-relaxed max-w-3xl">
            Aprenda a operar o ZENYDESK.ERP no dia a dia da sua empresa: cadastros de clientes e produtos, emissão de vendas e faturamento, controle de estoque e conciliação financeira.
        </p>
    </div>

    <!-- Etapas do Manual -->
    <div class="space-y-4 text-xs">

        <!-- Passo 1 -->
        <div class="p-6 rounded-2xl glass-card space-y-2.5">
            <div class="flex items-center gap-3">
                <span class="w-7 h-7 rounded-lg bg-blue-600 text-white font-bold flex items-center justify-center shrink-0">1</span>
                <h3 class="text-base font-bold text-white">Configuração Inicial da Empresa</h3>
            </div>
            <p class="text-slate-400 leading-relaxed pl-10">
                Acesse o menu <strong>Configurações ➔ Empresas</strong>. Atualize a Razão Social, CNPJ, Inscrição Estadual, logotipo e endereço completo da sua sede. Esses dados serão impressos automaticamente nos recibos e pedidos de venda.
            </p>
        </div>

        <!-- Passo 2 -->
        <div class="p-6 rounded-2xl glass-card space-y-2.5">
            <div class="flex items-center gap-3">
                <span class="w-7 h-7 rounded-lg bg-blue-600 text-white font-bold flex items-center justify-center shrink-0">2</span>
                <h3 class="text-base font-bold text-white">Cadastro de Clientes e Fornecedores (Parceiros)</h3>
            </div>
            <p class="text-slate-400 leading-relaxed pl-10">
                No menu lateral, clique em <strong>Contatos / Parceiros ➔ Novo</strong>. Preencha nome/razão social, CPF/CNPJ, WhatsApp e e-mail. Defina se o contato é um Cliente, Fornecedor ou ambos para direcionar os lançamentos de compras e vendas.
            </p>
        </div>

        <!-- Passo 3 -->
        <div class="p-6 rounded-2xl glass-card space-y-2.5">
            <div class="flex items-center gap-3">
                <span class="w-7 h-7 rounded-lg bg-blue-600 text-white font-bold flex items-center justify-center shrink-0">3</span>
                <h3 class="text-base font-bold text-white">Catálogo de Produtos e Controle de Estoque</h3>
            </div>
            <p class="text-slate-400 leading-relaxed pl-10">
                Vá em <strong>Produtos ➔ Adicionar Produto</strong>. Informe a descrição, código de barras (EAN), preço de venda e preço de custo. Habilite a opção "Controlar Estoque" e configure o alerta de estoque mínimo para ser notificado antes que o item esgote.
            </p>
        </div>

        <!-- Passo 4 -->
        <div class="p-6 rounded-2xl glass-card space-y-2.5">
            <div class="flex items-center gap-3">
                <span class="w-7 h-7 rounded-lg bg-blue-600 text-white font-bold flex items-center justify-center shrink-0">4</span>
                <h3 class="text-base font-bold text-white">Lançamento de Vendas & Faturamento</h3>
            </div>
            <p class="text-slate-400 leading-relaxed pl-10">
                Acesse <strong>Vendas ➔ Pedidos de Venda ➔ Novo Pedido</strong>. Selecione o cliente, adicione os produtos desejados com as quantidades e escolha as condições de pagamento (À vista, Parcelado, Pix, Boleto ou Cartão). Ao aprovar o pedido, o estoque baixa automaticamente.
            </p>
        </div>

        <!-- Passo 5 -->
        <div class="p-6 rounded-2xl glass-card space-y-2.5">
            <div class="flex items-center gap-3">
                <span class="w-7 h-7 rounded-lg bg-blue-600 text-white font-bold flex items-center justify-center shrink-0">5</span>
                <h3 class="text-base font-bold text-white">Contas a Pagar, Contas a Receber & Fluxo de Caixa</h3>
            </div>
            <p class="text-slate-400 leading-relaxed pl-10">
                Na aba <strong>Financeiro / Contabilidade</strong>, acompanhe o fluxo de caixa diário. Marque recebimentos confirmados e registre os pagamentos a fornecedores. O sistema calcula o saldo líquido em tempo real e emite o demonstrativo de receitas e despesas.
            </p>
        </div>

    </div>

</div>
@endsection
