@extends('help.layout')

@section('title', 'Hospedagem em Nuvem - ZENYDESK.ERP')

@section('content')
<div class="space-y-6">

    <!-- Hero Card -->
    <div class="p-8 rounded-3xl glass-card border-blue-500/30 relative overflow-hidden shadow-2xl">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-semibold uppercase tracking-wider mb-4">
            Infraestrutura Própria & Dedicada no Brasil
        </div>
        <h1 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight leading-tight">
            Hospedagem em Nuvem Corporativa ZENYDESK.ERP
        </h1>
        <p class="mt-3 text-sm sm:text-base text-slate-400 leading-relaxed max-w-3xl">
            Implante e escale a operação da sua empresa em servidores dedicados de alta performance, com latência reduzida no Brasil, isolamento de dados por contêiner e certificação SSL Wildcard automática.
        </p>
    </div>

    <!-- Grid de Pilares Técnicos -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div class="p-6 rounded-2xl glass-card space-y-3">
            <div class="w-10 h-10 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
            <h3 class="text-base font-bold text-white">Subdomínio Próprio & DNS Wildcard</h3>
            <p class="text-xs text-slate-400 leading-relaxed">
                Cada empresa assinante recebe seu próprio endereço exclusivo (<code class="text-blue-400">https://suaempresa.erp.zenydesk.com</code>). O DNS curinga e o roteador Nginx cuidam da entrega instantânea sem apontamentos manuais.
            </p>
        </div>

        <div class="p-6 rounded-2xl glass-card space-y-3">
            <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <h3 class="text-base font-bold text-white">Segurança TLS 1.3 & Criptografia</h3>
            <p class="text-xs text-slate-400 leading-relaxed">
                Certificados SSL emitidos pelo Let's Encrypt com chave forte de 256 bits e protocolo TLS 1.3. Toda transmissão de pedidos, notas e dados bancários trafega criptografada de ponta a ponta.
            </p>
        </div>

        <div class="p-6 rounded-2xl glass-card space-y-3">
            <div class="w-10 h-10 rounded-xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center text-purple-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2 1 3 3 3h10c2 0 3-1 3-3V7c0-2-1-3-3-3H7C5 4 4 5 4 7z"/></svg>
            </div>
            <h3 class="text-base font-bold text-white">Isolamento Lógico MariaDB & Docker</h3>
            <p class="text-xs text-slate-400 leading-relaxed">
                As consultas e operações de cada assinante são isoladas através de escopos de empresa (<code class="text-purple-300">CompanyScope</code>). Os dados de um cliente nunca são visíveis por outro.
            </p>
        </div>

        <div class="p-6 rounded-2xl glass-card space-y-3">
            <div class="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3 class="text-base font-bold text-white">Backups Diários em Nuvem</h3>
            <p class="text-xs text-slate-400 leading-relaxed">
                Cópias de segurança diárias automatizadas com redundância geográfica e política de retenção para restauração rápida em qualquer cenário de contingência.
            </p>
        </div>

    </div>

    <!-- Passo a Passo de Implantação -->
    <div class="p-6 sm:p-8 rounded-2xl glass-card space-y-4">
        <h2 class="text-xl font-bold text-white tracking-tight flex items-center gap-2">
            <span>Como Implantar seu Ambiente em 3 Passos</span>
        </h2>
        <div class="space-y-4 text-xs text-slate-300">
            <div class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-900/60 border border-slate-800">
                <div class="w-6 h-6 rounded-lg bg-blue-600 text-white font-bold flex items-center justify-center shrink-0">1</div>
                <div>
                    <h4 class="font-bold text-white text-sm">Defina o Subdomínio Desejado</h4>
                    <p class="text-slate-400 mt-0.5">Acesse a página <a href="/assinar" class="text-blue-400 underline font-semibold">https://erp.zenydesk.com/assinar</a> e escolha o nome da sua empresa.</p>
                </div>
            </div>
            <div class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-900/60 border border-slate-800">
                <div class="w-6 h-6 rounded-lg bg-blue-600 text-white font-bold flex items-center justify-center shrink-0">2</div>
                <div>
                    <h4 class="font-bold text-white text-sm">Selecione os Módulos do seu Plano</h4>
                    <p class="text-slate-400 mt-0.5">Contrate o núcleo base e adicione os módulos específicos que sua equipe utiliza, pagando um valor justo em reais.</p>
                </div>
            </div>
            <div class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-900/60 border border-slate-800">
                <div class="w-6 h-6 rounded-lg bg-blue-600 text-white font-bold flex items-center justify-center shrink-0">3</div>
                <div>
                    <h4 class="font-bold text-white text-sm">Ativação Instantânea via Pix ou Cartão</h4>
                    <p class="text-slate-400 mt-0.5">Após a compensação do pagamento, nosso webhook provisiona o ambiente MariaDB e libera seu acesso no mesmo segundo.</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
