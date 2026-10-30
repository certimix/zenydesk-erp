<x-filament-panels::page class="fi-home-page" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    @php
        $rawContent = $this->getContent();
        $isDefaultContent = empty($rawContent) || trim(strip_tags($rawContent)) === 'Home Content';
    @endphp

    @if (! $isDefaultContent)
        <div class="fi-prose {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}" style="font-family: {{ app()->getLocale() === 'ar' ? 'Cairo, sans-serif' : 'inherit' }};">
            {!! str($rawContent)->sanitizeHtml() !!}
        </div>
    @else
        <!-- Estilos Dedicados Garantidos para o Portal ZenyDesk ERP com MagnetLines Background -->
        <style>
            .zd-hero-wrapper {
                position: relative;
                width: 100%;
                min-height: 520px;
                background-color: #0a0e17;
                border-radius: 24px;
                padding: 56px 24px 48px 24px;
                margin-bottom: 36px;
                border: 1px solid rgba(255, 255, 255, 0.1);
                overflow: hidden;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.45);
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                text-align: center;
            }

            /* MagnetLines CSS Oficial React Bits */
            .magnet-lines {
                position: absolute;
                inset: 0;
                width: 100%;
                height: 100%;
                overflow: hidden;
                pointer-events: none;
                z-index: 1;
            }
            .magnet-lines__canvas {
                position: absolute;
                display: block;
                pointer-events: none;
            }
            .magnet-lines__probe {
                position: absolute;
                top: 0;
                left: 0;
                height: 0;
                visibility: hidden;
                pointer-events: none;
            }

            .zd-hero-content {
                position: relative;
                z-index: 2;
                max-width: 860px;
                margin: 0 auto;
                pointer-events: none;
            }
            .zd-hero-content a,
            .zd-hero-content button {
                pointer-events: auto;
            }

            .zd-badge-pill {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 6px 16px;
                border-radius: 9999px;
                font-size: 13px;
                font-weight: 600;
                color: #e0e7ff !important;
                background-color: rgba(21, 93, 252, 0.22) !important;
                border: 1px solid rgba(147, 197, 253, 0.35);
                backdrop-filter: blur(8px);
                margin-bottom: 24px;
            }

            .zd-hero-title {
                font-size: 38px;
                font-weight: 900;
                line-height: 1.15;
                color: #ffffff !important;
                letter-spacing: -0.03em;
                margin-bottom: 16px;
                text-shadow: 0 2px 10px rgba(0, 0, 0, 0.6);
            }
            @media (min-width: 640px) {
                .zd-hero-title {
                    font-size: 48px;
                }
            }
            @media (min-width: 1024px) {
                .zd-hero-title {
                    font-size: 54px;
                }
            }

            .zd-hero-subtitle {
                font-size: 16px;
                line-height: 1.65;
                color: #cbd5e1 !important;
                max-width: 700px;
                margin: 0 auto 32px auto;
                text-shadow: 0 1px 4px rgba(0, 0, 0, 0.5);
            }
            @media (min-width: 640px) {
                .zd-hero-subtitle {
                    font-size: 18px;
                }
            }

            .zd-btn-primary {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                padding: 15px 34px;
                font-size: 15px;
                font-weight: 700;
                color: #ffffff !important;
                background-color: #155dfc !important;
                border-radius: 12px;
                text-decoration: none !important;
                box-shadow: 0 4px 20px rgba(21, 93, 252, 0.5);
                transition: all 0.2s ease;
                cursor: pointer;
            }
            .zd-btn-primary:hover {
                background-color: #0c4ad4 !important;
                transform: translateY(-2px);
                box-shadow: 0 8px 28px rgba(21, 93, 252, 0.7);
            }

            .zd-btn-secondary {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                padding: 15px 28px;
                font-size: 15px;
                font-weight: 600;
                color: #ffffff !important;
                background-color: rgba(255, 255, 255, 0.08) !important;
                border: 1px solid rgba(255, 255, 255, 0.25) !important;
                border-radius: 12px;
                text-decoration: none !important;
                backdrop-filter: blur(8px);
                transition: all 0.2s ease;
                cursor: pointer;
            }
            .zd-btn-secondary:hover {
                background-color: rgba(255, 255, 255, 0.16) !important;
                border-color: rgba(255, 255, 255, 0.45) !important;
                transform: translateY(-2px);
            }

            .zd-trust-card {
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 14px;
                padding: 14px 18px;
                text-align: center;
                backdrop-filter: blur(6px);
            }

            .zd-feature-card {
                background: #ffffff;
                border: 1px solid #e2e8f0;
                border-radius: 16px;
                padding: 24px;
                transition: all 0.25s ease;
                display: flex;
                flex-direction: column;
                box-shadow: 0 2px 4px rgba(0,0,0,0.03);
            }
            .zd-feature-card:hover {
                border-color: #93c5fd;
                transform: translateY(-4px);
                box-shadow: 0 10px 25px rgba(21, 93, 252, 0.1);
            }
            .zd-icon-box {
                width: 48px;
                height: 48px;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 16px;
            }

            .zd-pricing-banner {
                background: linear-gradient(135deg, #090d16 0%, #152445 100%);
                border-radius: 20px;
                padding: 40px 32px;
                color: #ffffff;
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
                margin-top: 32px;
                margin-bottom: 24px;
                box-shadow: 0 10px 30px rgba(9, 13, 22, 0.3);
            }
        </style>

        <div class="max-w-6xl mx-auto px-2 sm:px-4">
            <!-- 1. Hero Section com MagnetLines Exclusivo no Fundo -->
            <div class="zd-hero-wrapper text-center">
                <!-- Container Oficial do MagnetLines (React Bits WebGL2) -->
                <div id="zd-magnet-lines" class="magnet-lines"></div>

                <div class="zd-hero-content">
                    <!-- Selo de Garantia e Infraestrutura -->
                    <div class="zd-badge-pill">
                        <svg class="w-4 h-4 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        <span>Infraestrutura Própria no Brasil • Multi-Tenant com Isolamento Total</span>
                    </div>

                    <!-- Título Principal de Alto Impacto e Clareza Absoluta -->
                    <h1 class="zd-hero-title">
                        Gestão Empresarial Integrada e Inteligente
                    </h1>

                    <!-- Subtítulo Explicativo de Alto Valor -->
                    <p class="zd-hero-subtitle">
                        Controle financeiro, emissão de faturas, frente de caixa (PDV), estoque, compras e vendas em um ambiente em nuvem veloz, escalável e desenhado para impulsionar a lucratividade da sua empresa.
                    </p>

                    <!-- Botões de Ação com Cores e Contraste Máximo -->
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-10">
                        <a href="{{ url('/assinar') }}" class="zd-btn-primary w-full sm:w-auto">
                            <span>Assinar ZenyDesk ERP</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>

                        <a href="https://wa.me/557598626311" target="_blank" rel="noopener noreferrer" class="zd-btn-secondary w-full sm:w-auto">
                            <svg class="w-5 h-5 fill-current" style="color: #25D366;" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            <span>Falar no WhatsApp</span>
                        </a>
                    </div>

                    <!-- 4 Indicadores de Confiança Técnica -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 max-w-4xl mx-auto pt-4 border-t border-slate-700/60">
                        <div class="zd-trust-card">
                            <div class="text-xs font-bold uppercase tracking-wider text-blue-400 mb-1">Provisionamento</div>
                            <div class="text-sm font-semibold text-white">Ativação em &lt; 2s</div>
                        </div>
                        <div class="zd-trust-card">
                            <div class="text-xs font-bold uppercase tracking-wider text-emerald-400 mb-1">Isolamento</div>
                            <div class="text-sm font-semibold text-white">Subdomínio Próprio</div>
                        </div>
                        <div class="zd-trust-card">
                            <div class="text-xs font-bold uppercase tracking-wider text-purple-300 mb-1">Soberania</div>
                            <div class="text-sm font-semibold text-white">Banco Dedicado</div>
                        </div>
                        <div class="zd-trust-card">
                            <div class="text-xs font-bold uppercase tracking-wider text-cyan-300 mb-1">Disponibilidade</div>
                            <div class="text-sm font-semibold text-white">SLA 99.9% em Nuvem</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Seção de Pilares Operacionais (Módulos) -->
            <div class="mb-8">
                <div class="text-center mb-8">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
                        Tudo o que sua Empresa Precisa para Crescer
                    </h2>
                    <p class="text-sm sm:text-base text-gray-600">
                        Módulos integrados de fábrica, sem remendos, com navegação rápida e relatórios em tempo real.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Módulo 1: Financeiro -->
                    <div class="zd-feature-card">
                        <div class="zd-icon-box" style="background-color: #eff6ff; color: #155dfc;">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Financeiro & Faturamento</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Controle total de contas a pagar e receber, fluxo de caixa diário, liquidação programada e conciliação bancária sem erros.
                        </p>
                    </div>

                    <!-- Módulo 2: Frente de Caixa / PDV -->
                    <div class="zd-feature-card">
                        <div class="zd-icon-box" style="background-color: #ecfdf5; color: #059669;">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Frente de Caixa (PDV)</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Ponto de venda ágil com leitor de código de barras, múltiplos meios de pagamento, controle de operadores e fechamento cego de turno.
                        </p>
                    </div>

                    <!-- Módulo 3: Estoque & Compras -->
                    <div class="zd-feature-card">
                        <div class="zd-icon-box" style="background-color: #fef3c7; color: #d97706;">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Estoque & Compras</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Rastreamento de mercadorias, alerta de estoque mínimo, gestão de fornecedores e cotação inteligente de reposição.
                        </p>
                    </div>

                    <!-- Módulo 4: Vendas & CRM -->
                    <div class="zd-feature-card">
                        <div class="zd-icon-box" style="background-color: #f3e8ff; color: #7e22ce;">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Vendas & Clientes (CRM)</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Propostas comerciais em PDF com 1 clique, funil de negociação de vendas e histórico completo de relacionamento com os clientes.
                        </p>
                    </div>

                    <!-- Módulo 5: Projetos & Operações -->
                    <div class="zd-feature-card">
                        <div class="zd-icon-box" style="background-color: #e0e7ff; color: #4338ca;">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Projetos & Tarefas</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Organização de entregas em quadros visuais, acompanhamento de prazos, alocação de equipe e produtividade operacional.
                        </p>
                    </div>

                    <!-- Módulo 6: Atendimento & Chat Corporativo -->
                    <div class="zd-feature-card">
                        <div class="zd-icon-box" style="background-color: #f1f5f9; color: #0f172a;">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Suporte & Chamados Integrados</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Widget de atendimento nativo direto no painel do ERP com canal exclusivo e triagem prioritária de chamados técnicos.
                        </p>
                    </div>
                </div>
            </div>

            <!-- 3. Banner de Conversão Final -->
            <div class="zd-pricing-banner">
                <span style="display: inline-block; padding: 4px 12px; background: rgba(255,255,255,0.15); border-radius: 9999px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 12px;">
                    Comece Agora em Poucos Cliques
                </span>
                <h2 style="font-size: 28px; font-weight: 800; margin-bottom: 12px; color: #ffffff;">
                    Pronto para Elevar o Padrão de Gestão da sua Empresa?
                </h2>
                <p style="font-size: 15px; color: #cbd5e1; max-width: 600px; margin-bottom: 24px; line-height: 1.6;">
                    Escolha o subdomínio exclusivo do seu negócio, selecione os módulos sob medida e ative seu ERP imediatamente via Pix ou Cartão.
                </p>
                <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 12px;">
                    <a href="{{ url('/assinar') }}" class="zd-btn-primary" style="background-color: #2563eb !important; border: 2px solid #60a5fa !important;">
                        <span>Ir para Página de Assinatura</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                    <a href="https://wa.me/557598626311" target="_blank" rel="noopener noreferrer" class="zd-btn-secondary" style="background-color: rgba(255,255,255,0.1) !important; color: #ffffff !important; border-color: rgba(255,255,255,0.3) !important;">
                        <span>Dúvidas? Chame no WhatsApp</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Script de Inicialização Oficial do MagnetLines -->
        <script src="{{ asset('js/magnet-lines.js') }}?v={{ file_exists(public_path('js/magnet-lines.js')) ? filemtime(public_path('js/magnet-lines.js')) : time() }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var container = document.getElementById('zd-magnet-lines');
                if (container && window.initMagnetLines) {
                    window.initMagnetLines(container, {
                        lineColor: '#efefef',
                        spacing: 30,
                        lineWidth: 2,
                        lineHeight: 18,
                        mode: 'orbit',
                        shape: 'line',
                        radius: 200,
                        fade: 0.65,
                        baseAngle: -10,
                        edgeFade: 0,
                        stretch: 0.4,
                        reach: 0,
                        scatter: 0,
                        inertia: 0.35,
                        bounce: 0.3,
                        ripple: 0.3,
                        rainbow: false,
                        tiltX: 0,
                        tiltY: 0,
                        clickPulse: true,
                        intro: true,
                        idle: false
                    });
                }
            });
        </script>
    @endif
</x-filament-panels::page>