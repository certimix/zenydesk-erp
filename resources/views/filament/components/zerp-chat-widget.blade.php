@php
    $erpUser = Auth::user();
    $userName = $erpUser ? $erpUser->name : 'Cliente ERP';
    $userEmail = $erpUser ? $erpUser->email : '';
    $userRole = 'Gestor ERP';
    if ($erpUser && method_exists($erpUser, 'roles')) {
        $firstRole = $erpUser->roles->first();
        if ($firstRole) {
            $userRole = $firstRole->name;
        }
    }
@endphp

<div id="zerp-support-widget-container" style="font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;">
    <!-- Botão Flutuante (Launcher) -->
    <button id="zerp-widget-launcher"
            type="button"
            onclick="toggleZerpChat()"
            class="fixed bottom-6 right-6 z-[9999] group flex items-center gap-3 px-4 py-3 rounded-2xl bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 text-white shadow-2xl border border-indigo-500/40 hover:border-indigo-400 hover:shadow-indigo-500/20 transition-all duration-300 hover:scale-105 cursor-pointer">
        <div class="relative flex items-center justify-center w-8 h-8 rounded-xl bg-indigo-600/30 border border-indigo-400/40 text-indigo-300">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 100-6 3 3 0 000 6z" />
            </svg>
            <span class="absolute -top-1 -right-1 flex h-2.5 w-2.5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
            </span>
        </div>
        <div class="flex flex-col text-left">
            <div class="flex items-center gap-1.5">
                <span class="font-extrabold text-xs tracking-wide text-white">Suporte Z.ERP</span>
                <span class="px-1.5 py-0.2 rounded text-[9px] font-extrabold uppercase bg-emerald-500/20 text-emerald-300 border border-emerald-500/40">Privado</span>
            </div>
            <span class="text-[10px] text-slate-400">Canal Direto com Especialistas</span>
        </div>
        <span id="zerp-unread-badge" class="hidden ml-1 px-1.5 py-0.5 rounded-full text-[10px] font-bold bg-rose-500 text-white animate-bounce">
            1
        </span>
    </button>

    <!-- Janela de Chat Flutuante -->
    <div id="zerp-widget-window"
         class="hidden fixed bottom-6 right-6 z-[10000] w-[92vw] sm:w-[390px] h-[550px] max-h-[88vh] rounded-3xl bg-[#090d16] border border-slate-800/90 shadow-2xl shadow-black/80 flex flex-col overflow-hidden transition-all duration-200">
        
        <!-- Topo / Header Executivo do Widget -->
        <div class="px-4 py-3 bg-[#0c1220] border-b border-slate-800/80 flex items-center justify-between gap-2 shrink-0">
            <div class="flex items-center gap-2.5 min-w-0">
                <div class="w-9 h-9 rounded-xl bg-indigo-600/20 border border-indigo-500/30 flex items-center justify-center text-indigo-400 shrink-0 shadow-inner">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 100-6 3 3 0 000 6z" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <div class="flex items-center gap-2">
                        <h3 class="font-bold text-xs sm:text-sm text-white truncate">Suporte Direto Z.ERP</h3>
                        <span class="px-1.5 py-0.5 rounded text-[9px] font-extrabold uppercase bg-emerald-500/15 text-emerald-400 border border-emerald-500/30 shrink-0">PRIVADO</span>
                    </div>
                    <div class="flex items-center gap-1.5 text-[10px] text-slate-400">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span class="truncate">Atendimento exclusivo com nossa equipe</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-1 shrink-0">
                <button type="button" onclick="minimizeZerpChat()" class="p-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800/60 transition cursor-pointer" title="Minimizar">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <button type="button" onclick="closeZerpChat()" class="p-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800/60 transition cursor-pointer" title="Fechar">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>

        <!-- Seletor de Canal (Exclusivo Suporte Z.ERP Privado) -->
        <div class="px-3 py-2 bg-[#080b12] border-b border-slate-800/60 shrink-0">
            <div class="p-1 rounded-xl bg-slate-900/90 border border-slate-800/80 flex items-center">
                <div class="flex-1 py-1.5 px-3 rounded-lg bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-bold text-xs flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-2">
                        <svg class="w-3.5 h-3.5 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 100-6 3 3 0 000 6z" /></svg>
                        <span>Suporte Z.ERP</span>
                    </div>
                    <span class="px-1.5 py-0.2 rounded text-[9px] font-extrabold bg-indigo-950/70 text-indigo-200 border border-indigo-400/30">Privado</span>
                </div>
            </div>
        </div>

        <!-- Barra de Identidade do Cliente ERP -->
        <div class="px-4 py-1.5 bg-[#0a0e18] border-b border-slate-800/60 flex items-center justify-between text-[11px] shrink-0">
            <div class="flex items-center gap-1.5 text-slate-300 truncate max-w-[200px]">
                <svg class="w-3 h-3 text-slate-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                <span class="font-semibold truncate text-white" id="zerp-client-display-name">{{ $userName }}</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="px-1.5 py-0.2 rounded text-[9px] font-bold bg-purple-500/20 text-purple-300 border border-purple-500/30">{{ $userRole }}</span>
                <span class="font-mono text-[9px] text-slate-500" id="zerp-short-session-badge">#zerp-init</span>
            </div>
        </div>

        <!-- Área de Rolagem de Mensagens -->
        <div id="zerp-messages-box" class="flex-1 p-4 overflow-y-auto space-y-3.5 bg-[#070a11]/90">
            <!-- Mensagem Inicial de Acolhimento do Bot Z.ERP -->
            <div class="flex flex-col items-start space-y-1">
                <div class="flex items-center gap-1.5 text-[10px] text-slate-400">
                    <span class="font-bold text-indigo-400">Suporte ZenyDesk</span>
                    <span class="text-slate-600">•</span>
                    <span class="text-slate-500" id="zerp-initial-time">agora</span>
                </div>
                <div class="p-3.5 rounded-2xl rounded-tl-sm bg-[#0d1424] border border-emerald-500/40 text-slate-200 text-xs leading-relaxed shadow-lg max-w-[92%]">
                    <p>👋 Olá, <span class="font-bold text-white">{{ $userName }}</span>! Bem-vindo ao <strong>Suporte Direto Z.ERP</strong>.</p>
                    <p class="mt-1.5 text-slate-300">Suas dúvidas operacionais, fiscais, relatórios ou módulos neste canal são <strong>100% privadas</strong> e chegam diretamente aos nossos operadores de plantão. Como podemos ajudar hoje?</p>
                </div>
                <div class="flex items-center gap-1 text-[9px] text-emerald-400 font-semibold pl-1">
                    <svg class="w-3 h-3 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    <span>Atendente Especialista Z.ERP</span>
                </div>
            </div>

            <!-- As mensagens dinâmicas serão injetadas aqui via JavaScript -->
            <div id="zerp-dynamic-messages" class="space-y-3.5"></div>
        </div>

        <!-- Rodapé e Campo de Digitação -->
        <div class="p-3 bg-[#0a0e18] border-t border-slate-800/80 shrink-0 space-y-2">
            <form id="zerp-chat-form" onsubmit="sendZerpMessage(event)" class="flex items-center gap-2">
                <input type="text"
                       id="zerp-message-input"
                       placeholder="Digite sua dúvida sobre o ZenyDesk ERP..."
                       autocomplete="off"
                       class="flex-1 py-2.5 px-3.5 rounded-xl bg-slate-900/90 border border-slate-700/80 text-white placeholder-slate-500 text-xs focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition shadow-inner">
                <button type="submit"
                        id="zerp-send-btn"
                        class="p-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 text-white transition shadow-lg shadow-indigo-600/30 flex items-center justify-center shrink-0 cursor-pointer disabled:opacity-50">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                </button>
            </form>

            <div class="flex items-center justify-between text-[9px] text-slate-500 px-1">
                <div class="flex items-center gap-1 text-slate-400">
                    <svg class="w-2.5 h-2.5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    <span>Canal Direto com ZenyDesk (Privado)</span>
                </div>
                <div class="flex items-center gap-1 text-emerald-400">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Conexão Segura Ativa</span>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
(function() {
    const API_BASE = 'https://zenydesk.com';
    const CLIENT_NAME = @json($userName);
    const CLIENT_EMAIL = @json($userEmail);
    
    // Recupera ou cria Session ID persistente do Z.ERP
    let sessionId = localStorage.getItem('zenydesk_zerp_chat_session');
    if (!sessionId) {
        sessionId = 'zerp-' + Math.random().toString(36).substring(2, 9) + '-' + Date.now().toString(36);
        localStorage.setItem('zenydesk_zerp_chat_session', sessionId);
    }

    const shortId = '#' + sessionId.slice(-8);
    const badgeEl = document.getElementById('zerp-short-session-badge');
    if (badgeEl) badgeEl.textContent = shortId;

    let sseSource = null;
    let pollInterval = null;
    let isWindowOpen = false;
    let loadedMessageIds = new Set();

    // Toggle da janela
    window.toggleZerpChat = function() {
        const win = document.getElementById('zerp-widget-window');
        const launcher = document.getElementById('zerp-widget-launcher');
        const unread = document.getElementById('zerp-unread-badge');
        if (!win) return;

        isWindowOpen = !isWindowOpen;
        if (isWindowOpen) {
            win.classList.remove('hidden');
            launcher.classList.add('hidden');
            if (unread) unread.classList.add('hidden');
            initChatSync();
            scrollChatToBottom();
            setTimeout(() => {
                const input = document.getElementById('zerp-message-input');
                if (input) input.focus();
            }, 100);
        } else {
            win.classList.add('hidden');
            launcher.classList.remove('hidden');
        }
    };

    window.openZerpChat = function() {
        if (!isWindowOpen) {
            window.toggleZerpChat();
        }
    };

    window.minimizeZerpChat = function() {
        window.toggleZerpChat();
    };

    window.closeZerpChat = function() {
        const win = document.getElementById('zerp-widget-window');
        const launcher = document.getElementById('zerp-widget-launcher');
        if (win) win.classList.add('hidden');
        if (launcher) launcher.classList.remove('hidden');
        isWindowOpen = false;
    };

    function scrollChatToBottom() {
        const box = document.getElementById('zerp-messages-box');
        if (box) {
            setTimeout(() => {
                box.scrollTop = box.scrollHeight;
            }, 50);
        }
    }

    function renderMessage(msg) {
        if (!msg || !msg.id || loadedMessageIds.has(msg.id)) return;
        loadedMessageIds.add(msg.id);

        const container = document.getElementById('zerp-dynamic-messages');
        if (!container) return;

        const isClient = msg.sender === 'client';
        const msgDiv = document.createElement('div');
        msgDiv.className = `flex flex-col ${isClient ? 'items-end' : 'items-start'} space-y-1`;

        const timeStr = msg.timestamp ? new Date(msg.timestamp).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) : 'agora';

        if (isClient) {
            msgDiv.innerHTML = `
                <div class="flex items-center gap-1.5 text-[10px] text-slate-400">
                    <span class="text-slate-500">${timeStr}</span>
                    <span class="font-bold text-white">${escapeHtml(msg.senderName || CLIENT_NAME)}</span>
                </div>
                <div class="p-3 rounded-2xl rounded-tr-sm bg-indigo-600 text-white text-xs leading-relaxed shadow-md max-w-[85%] break-words">
                    ${escapeHtml(msg.content)}
                </div>
            `;
        } else {
            msgDiv.innerHTML = `
                <div class="flex items-center gap-1.5 text-[10px] text-slate-400">
                    <span class="font-bold text-indigo-400">${escapeHtml(msg.senderName || 'Suporte Técnico')}</span>
                    <span class="text-slate-600">•</span>
                    <span class="text-slate-500">${timeStr}</span>
                </div>
                <div class="p-3 rounded-2xl rounded-tl-sm bg-[#0d1424] border border-indigo-500/30 text-slate-200 text-xs leading-relaxed shadow-md max-w-[85%] break-words">
                    ${escapeHtml(msg.content)}
                </div>
                <div class="flex items-center gap-1 text-[9px] text-emerald-400 font-semibold pl-1">
                    <svg class="w-3 h-3 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    <span>Atendente Técnico Oficial</span>
                </div>
            `;
        }

        container.appendChild(msgDiv);
        scrollChatToBottom();

        // Se a janela estiver fechada e a mensagem for do técnico, exibe badge
        if (!isWindowOpen && !isClient) {
            const badge = document.getElementById('zerp-unread-badge');
            if (badge) badge.classList.remove('hidden');
        }
    }

    function escapeHtml(text) {
        if (!text) return '';
        return text
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    async function fetchMessages() {
        try {
            const res = await fetch(`${API_BASE}/api/support/chat/session/${encodeURIComponent(sessionId)}/messages`);
            if (!res.ok) return;
            const data = await res.json();
            if (data.success && Array.isArray(data.messages)) {
                data.messages.forEach(msg => renderMessage(msg));
            }
        } catch (e) {
            console.warn('[Z.ERP Support] Erro na sincronização:', e);
        }
    }

    function initChatSync() {
        fetchMessages();

        if (sseSource) {
            try { sseSource.close(); } catch {}
        }

        try {
            sseSource = new EventSource(`${API_BASE}/api/support/chat/session/${encodeURIComponent(sessionId)}/events`);
            sseSource.onmessage = function(event) {
                try {
                    const data = JSON.parse(event.data);
                    if (data.type === 'new_message' && data.message) {
                        renderMessage(data.message);
                    }
                } catch {}
            };
            sseSource.onerror = function() {
                // Se o SSE falhar, mantemos o polling
            };
        } catch (e) {
            console.warn('[Z.ERP Support] SSE indisponível, usando polling:', e);
        }

        if (!pollInterval) {
            pollInterval = setInterval(fetchMessages, 4000);
        }
    }

    window.sendZerpMessage = async function(e) {
        if (e) e.preventDefault();
        const input = document.getElementById('zerp-message-input');
        const sendBtn = document.getElementById('zerp-send-btn');
        if (!input) return;

        const content = input.value.trim();
        if (!content) return;

        input.value = '';
        input.disabled = true;
        if (sendBtn) sendBtn.disabled = true;

        // Renderização otimista
        const tempId = 'temp-' + Date.now();
        const optimisticMsg = {
            id: tempId,
            sender: 'client',
            senderName: CLIENT_NAME,
            content: content,
            timestamp: new Date().toISOString()
        };
        renderMessage(optimisticMsg);

        try {
            const res = await fetch(`${API_BASE}/api/support/chat/send`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    sessionId: sessionId,
                    clientName: CLIENT_NAME,
                    content: content,
                    channel: 'zerp-assist'
                })
            });

            const data = await res.json();
            if (data.success) {
                if (data.message && data.message.id) {
                    loadedMessageIds.add(data.message.id);
                }
                if (data.botReply) {
                    renderMessage(data.botReply);
                }
            }
        } catch (err) {
            console.error('[Z.ERP Support] Erro ao enviar mensagem:', err);
        } finally {
            input.disabled = false;
            if (sendBtn) sendBtn.disabled = false;
            input.focus();
        }
    };
})();
</script>
