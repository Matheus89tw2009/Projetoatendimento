<!DOCTYPE html>
<html lang="pt-BR" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chamado #{{ $ticket->id }} | Helpdesk</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* ===== SWITCH DE TEMA (Uiverse) ===== */

        /* The switch - the box around the slider */
        .switch {
            display: block;
            --width-of-switch: 3.5em;
            --height-of-switch: 2em;
            /* size of sliding icon -- sun and moon */
            --size-of-icon: 1.4em;
            /* it is like a inline-padding of switch */
            --slider-offset: 0.3em;
            position: relative;
            width: var(--width-of-switch);
            height: var(--height-of-switch);
            flex-shrink: 0;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            inset: 0;
            background-color: #f4f4f5;
            border: 1px solid #e2e8f0;
            border-radius: 30px;
            transition: background-color 0.25s ease, border-color 0.25s ease;
        }

        /* Sun */
        .slider::before {
            content: "";
            position: absolute;
            height: var(--size-of-icon);
            width: var(--size-of-icon);
            left: var(--slider-offset);
            top: 50%;
            transform: translateY(-50%);
            border-radius: 50%;
            background: linear-gradient(40deg, #ff0080, #ff8c00 70%);
            transition: left 0.25s ease, background 0.25s ease, box-shadow 0.25s ease;
        }

        /* Dark mode: moon */
        .switch input:checked + .slider {
            background-color: #303136;
            border-color: #3f3f46;
        }

        .switch input:checked + .slider::before {
            left: calc(100% - var(--size-of-icon) - var(--slider-offset) - 2px);
            background: #303136;
            box-shadow: inset -3px -2px 5px -2px #8983f7, inset -7px -1px 0 0 #a3dafb;
        }

        /* Keyboard focus */
        .switch input:focus-visible + .slider {
            outline: 2px solid #2563eb;
            outline-offset: 2px;
        }

        /* ===== BOTÃO "ACESSAR PAINEL" (Uiverse) ===== */
        .btn-star {
            --stone-50: #fafaf9;
            --stone-800: #292524;
            --accent: #60a5fa;
            --star-color: #ffffff;
            --inner: var(--stone-800);

            font-family: inherit;
            cursor: pointer;
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-weight: 700;
            line-height: 1;
            font-size: 0.6875rem;
            white-space: nowrap;
            text-decoration: none;
            border-radius: 1rem;
            outline: 2px solid transparent;
            outline-offset: 6px;
            color: var(--stone-50);
        }

        /* No tema claro a estrela fica azul para aparecer no fundo claro */
        html:not(.dark) .btn-star { --star-color: #60a5fa; }

        .btn-star:active { outline-color: var(--accent); }
        .btn-star:focus-visible {
            outline-color: var(--accent);
            outline-style: dashed;
        }

        /* Estrela giratória atrás do botão */
        .btn-star::before {
            content: "";
            position: absolute;
            z-index: 0;
            height: 200%;
            max-height: 76px;
            aspect-ratio: 1;
            margin: auto;
            background: var(--star-color);
            pointer-events: none;
            clip-path: polygon(
                100% 50%, 91.48% 56.57%, 97.55% 65.45%, 87.42% 69.07%, 90.45% 79.39%,
                79.7% 79.7%, 79.39% 90.45%, 69.07% 87.42%, 65.45% 97.55%, 56.57% 91.48%,
                50% 100%, 43.43% 91.48%, 34.55% 97.55%, 30.93% 87.42%, 20.61% 90.45%,
                20.3% 79.7%, 9.55% 79.39%, 12.58% 69.07%, 2.45% 65.45%, 8.52% 56.57%,
                0% 50%, 8.52% 43.43%, 2.45% 34.55%, 12.58% 30.93%, 9.55% 20.61%,
                20.3% 20.3%, 20.61% 9.55%, 30.93% 12.58%, 34.55% 2.45%, 43.43% 8.52%,
                50% 0%, 56.57% 8.52%, 65.45% 2.45%, 69.07% 12.58%, 79.39% 9.55%,
                79.7% 20.3%, 90.45% 20.61%, 87.42% 30.93%, 97.55% 34.55%, 91.48% 43.43%
            );
            animation: star-rotate 4s linear infinite;
            opacity: 0.1;
            transition: opacity 150ms ease;
        }
        .btn-star:hover::before { opacity: 1; }

        /* Camada 1: borda azul clara com sombra 3D */
        .btn-star > div {
            padding: 2px;
            border-radius: 1rem;
            background-color: var(--accent);
            transform: translate(-4px, -4px);
            transition: all 150ms ease;
            box-shadow:
                0.5px 0.5px 0 0 var(--accent),
                1px 1px 0 0 var(--accent),
                1.5px 1.5px 0 0 var(--accent),
                2px 2px 0 0 var(--accent),
                2.5px 2.5px 0 0 var(--accent),
                3px 3px 0 0 var(--accent),
                0 0 0 2px var(--stone-800),
                0.5px 0.5px 0 2px var(--stone-800),
                1px 1px 0 2px var(--stone-800),
                1.5px 1.5px 0 2px var(--stone-800),
                2px 2px 0 2px var(--stone-800),
                2.5px 2.5px 0 2px var(--stone-800),
                3px 3px 0 2px var(--stone-800),
                3.5px 3.5px 0 2px var(--stone-800),
                4px 4px 0 2px var(--stone-800),
                0 0 0 4px var(--stone-50),
                0.5px 0.5px 0 4px var(--stone-50),
                1px 1px 0 4px var(--stone-50),
                1.5px 1.5px 0 4px var(--stone-50),
                2px 2px 0 4px var(--stone-50),
                2.5px 2.5px 0 4px var(--stone-50),
                3px 3px 0 4px var(--stone-50),
                3.5px 3.5px 0 4px var(--stone-50),
                4px 4px 0 4px var(--stone-50);
        }

        /* Hover: o botão "afunda" e a sombra 3D some */
        .btn-star:hover > div {
            transform: translate(0, 0);
            box-shadow:
                0 0 0 0 var(--accent),
                0 0 0 0 var(--accent),
                0 0 0 0 var(--accent),
                0 0 0 0 var(--accent),
                0 0 0 0 var(--accent),
                0 0 0 0 var(--accent),
                0 0 0 2px var(--stone-800),
                0 0 0 2px var(--stone-800),
                0 0 0 2px var(--stone-800),
                0 0 0 2px var(--stone-800),
                0 0 0 2px var(--stone-800),
                0 0 0 2px var(--stone-800),
                0 0 0 2px var(--stone-800),
                0 0 0 2px var(--stone-800),
                0 0 0 2px var(--stone-800),
                0 0 0 4px var(--stone-50),
                0 0 0 4px var(--stone-50),
                0 0 0 4px var(--stone-50),
                0 0 0 4px var(--stone-50),
                0 0 0 4px var(--stone-50),
                0 0 0 4px var(--stone-50),
                0 0 0 4px var(--stone-50),
                0 0 0 4px var(--stone-50),
                0 0 0 4px var(--stone-50);
        }

        /* Camada 2: fundo escuro com textura de pontos animada */
        .btn-star > div > div {
            position: relative;
            pointer-events: none;
            border-radius: calc(1rem - 2px);
            background-color: var(--inner);
        }

        .btn-star > div > div::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 1rem;
            opacity: 0.1;
            background-image:
                radial-gradient(rgb(255 255 255 / 80%) 20%, transparent 20%),
                radial-gradient(rgb(255 255 255 / 100%) 20%, transparent 20%);
            background-position: 0 0, 4px 4px;
            background-size: 8px 8px;
            mix-blend-mode: hard-light;
            box-shadow: inset 0 0 0 1px var(--inner);
            animation: btn-dots 0.4s infinite linear;
            transition: opacity 150ms ease;
        }

        /* Camada 3: texto */
        .btn-star > div > div > div {
            position: relative;
            display: flex;
            align-items: center;
            padding: 0.4375rem 0.875rem;
            gap: 0.25rem;
            filter: drop-shadow(0 -1px 0 var(--inner));
            transition: filter 150ms ease, transform 150ms ease;
        }
        .btn-star:hover > div > div > div {
            filter: drop-shadow(0 -1px 0 rgba(255, 255, 255, 0.1));
        }
        .btn-star:active > div > div > div {
            transform: translateY(2px);
        }

        /* Variante azul: botão principal "Abrir um Chamado Agora" */
        .btn-star--primary {
            --inner: #2563eb;
            font-size: 0.8125rem;
        }
        .btn-star--primary > div > div > div {
            padding: 0.875rem 1.5rem;
            gap: 0.5rem;
        }

        /* Variante de largura total: botões de formulário */
        .btn-star--block {
            display: flex;
            width: 100%;
        }
        .btn-star--block > div {
            flex: 1;
        }
        .btn-star--block > div > div > div {
            justify-content: center;
        }

        /* Variantes de cor e tamanho (botões do chamado) */
        .btn-star--indigo { --inner: #4f46e5; }
        .btn-star--amber  { --inner: #d97706; }
        .btn-star--md > div > div > div {
            padding: 0.625rem 1.125rem;
        }

        @keyframes star-rotate {
            from { transform: rotate(0deg); }
            to   { transform: rotate(360deg); }
        }

        @keyframes btn-dots {
            0%   { background-position: 0 0, 4px 4px; }
            100% { background-position: 8px 0, 12px 4px; }
        }

        @media (prefers-reduced-motion: reduce) {
            .btn-star::before,
            .btn-star > div > div::before { animation: none; }
        }

        /* ===== UPLOAD DE ANEXO (Uiverse) ===== */
        .custum-file-upload {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            min-height: 7rem;
            padding: 1rem 1.25rem;
            text-align: center;
            cursor: pointer;
            border: 2px dashed #cbd5e1;
            border-radius: 0.75rem;
            background-color: #f8fafc;
            box-shadow: 0px 48px 35px -48px rgba(0, 0, 0, 0.1);
            transition: border-color 0.2s ease, background-color 0.2s ease, box-shadow 0.2s ease;
        }

        .dark .custum-file-upload {
            border-color: #334155;
            background-color: rgb(30 41 59 / 0.5);
        }

        .custum-file-upload:hover,
        .custum-file-upload:focus-within,
        .custum-file-upload.is-drag {
            border-color: #60a5fa;
            background-color: #eff6ff;
        }

        .dark .custum-file-upload:hover,
        .dark .custum-file-upload:focus-within,
        .dark .custum-file-upload.is-drag {
            background-color: rgb(23 37 84 / 0.3);
        }

        .custum-file-upload .icon {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .custum-file-upload .icon svg {
            height: 2.5rem;
            width: auto;
            fill: #64748b;
            transition: fill 0.2s ease, transform 0.2s ease;
        }

        .dark .custum-file-upload .icon svg { fill: #94a3b8; }

        .custum-file-upload:hover .icon svg,
        .custum-file-upload.is-drag .icon svg {
            fill: #2563eb;
            transform: translateY(-2px);
        }

        .dark .custum-file-upload:hover .icon svg,
        .dark .custum-file-upload.is-drag .icon svg { fill: #60a5fa; }

        .custum-file-upload .text {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.125rem;
            max-width: 100%;
        }

        .custum-file-upload .text span {
            font-size: 0.75rem;
            font-weight: 500;
            color: #64748b;
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .dark .custum-file-upload .text span { color: #94a3b8; }

        .custum-file-upload .text small {
            font-size: 0.625rem;
            color: #94a3b8;
        }

        /* O input cobre toda a área: clique e arrastar-e-soltar funcionam nativamente */
        .custum-file-upload input {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        /* Arquivo selecionado */
        .custum-file-upload.has-file {
            border-style: solid;
            border-color: #2563eb;
        }

        .custum-file-upload.has-file .text span { color: #2563eb; font-weight: 600; }
        .dark .custum-file-upload.has-file .text span { color: #60a5fa; }

        /* ===== CHAT (Uiverse) ===== */
        .chat-container {
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background-color: #ffffff;
            border: 1px solid rgb(226 232 240 / 0.8);
            border-radius: 1rem;
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        .dark .chat-container {
            background-color: #0f172a;
            border-color: #1e293b;
        }

        /* Barra superior */
        .chat-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            min-height: 2.75rem;
            padding: 0 1rem;
            background-color: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }
        .dark .chat-nav {
            background-color: #0f172a;
            border-bottom-color: #1e293b;
        }
        .chat-nav h2 {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8125rem;
            font-weight: 700;
            color: #0f172a;
            user-select: none;
        }
        .dark .chat-nav h2 { color: #ffffff; }
        .chat-nav-id {
            font-size: 0.625rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            color: #6b6c7b;
            user-select: none;
        }

        /* Área de mensagens com linhas alternadas */
        .chat-messages {
            max-height: 28rem;
            overflow-y: auto;
            scroll-behavior: smooth;
            scrollbar-width: thin;
            scrollbar-color: #94a3b8 transparent;
        }
        .chat-row { padding: 0.875rem 1rem; }
        .chat-row:nth-child(odd)  { background-color: #f8fafc; }
        .chat-row:nth-child(even) { background-color: #ffffff; }
        .dark .chat-row:nth-child(odd)  { background-color: rgb(30 41 59 / 0.45); }
        .dark .chat-row:nth-child(even) { background-color: #0f172a; }

        /* Área de envio */
        .chat-sender {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            padding: 0.875rem 1rem;
            background-color: #f8fafc;
            border-top: 1px solid #e2e8f0;
        }
        .dark .chat-sender {
            background-color: #0f172a;
            border-top-color: #1e293b;
        }

        /* Upload mais compacto dentro do chat */
        .chat-sender .custum-file-upload {
            flex-direction: row;
            justify-content: flex-start;
            min-height: 3.5rem;
            padding: 0.625rem 1rem;
            gap: 0.75rem;
            text-align: left;
        }
        .chat-sender .custum-file-upload .icon svg { height: 1.75rem; }
        .chat-sender .custum-file-upload .text { align-items: flex-start; }

        .chat-input-place {
            display: flex;
            align-items: flex-end;
            gap: 0.375rem;
            padding: 0.25rem 0.25rem 0.25rem 0.75rem;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .dark .chat-input-place {
            background-color: #1e293b;
            border-color: #334155;
        }
        .chat-input-place:focus-within {
            border-color: #60a5fa;
            box-shadow: 0 0 0 2px rgb(96 165 250 / 0.35);
        }

        .chat-input-place textarea {
            flex: 1;
            min-width: 0;
            min-height: 2.25rem;
            max-height: 8rem;
            padding: 0.5rem 0;
            font-size: 0.75rem;
            line-height: 1.4;
            color: #0f172a;
            background: none;
            border: none;
            outline: none;
            resize: none;
        }
        .dark .chat-input-place textarea { color: #ffffff; }
        .chat-input-place textarea::placeholder { color: #828e9e; }

        .chat-send {
            width: 2.25rem;
            height: 2.25rem;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: none;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        .chat-send svg {
            width: 1.0625rem;
            fill: #6b6c7b;
            transition: fill 0.2s ease, transform 0.2s ease;
        }
        .chat-send:hover svg { fill: #2563eb; transform: translateX(1px); }
        .dark .chat-send:hover svg { fill: #60a5fa; }
        .chat-send:hover { background-color: rgb(96 165 250 / 0.12); }
        .chat-send:focus-visible { outline: 2px solid #60a5fa; outline-offset: 1px; }
    </style>
</head>
<body class="bg-slate-100 dark:bg-slate-950 text-slate-800 dark:text-slate-100 min-h-screen pb-12 transition-colors duration-300">

    <nav class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 sticky top-0 z-20 transition-colors duration-300">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 py-4 flex justify-between items-center">
            
            <a href="/painel" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 px-3 py-1.5 rounded-xl transition">
                ← Voltar ao Painel
            </a>

            <div class="flex items-center gap-3">
                <!-- SWITCH DE TEMA -->
                <label class="switch" title="Alternar tema" aria-label="Alternar tema claro/escuro">
                    <input type="checkbox" id="theme-toggle">
                    <span class="slider"></span>
                </label>

                <div class="text-right">
                    <span class="block text-xs font-bold text-slate-800 dark:text-slate-200">{{ auth()->user()->name ?? 'Usuário' }}</span>
                    <span class="inline-block px-2 py-0.5 text-[10px] font-bold rounded-full {{ trim(strtolower(auth()->user()->tipo ?? '')) == 'tecnico' ? 'bg-purple-100 text-purple-700 dark:bg-purple-950/60 dark:text-purple-300' : 'bg-blue-100 text-blue-700 dark:bg-blue-950/60 dark:text-blue-300' }}">
                        {{ strtoupper(auth()->user()->tipo ?? 'CLIENTE') }}
                    </span>
                </div>
            </div>

        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 pt-8 space-y-6">

        @if(session('sucesso'))
            <div class="p-4 bg-emerald-50 dark:bg-emerald-950/50 border-l-4 border-emerald-500 rounded-r-2xl text-emerald-800 dark:text-emerald-200 text-xs font-semibold shadow-sm flex items-center gap-2">
                <span>✅</span> {{ session('sucesso') }}
            </div>
        @endif

        @if(session('erro'))
            <div class="p-4 bg-rose-50 dark:bg-rose-950/50 border-l-4 border-rose-500 rounded-r-2xl text-rose-800 dark:text-rose-200 text-xs font-semibold shadow-sm flex items-center gap-2">
                <span>⚠️</span> {{ session('erro') }}
            </div>
        @endif

        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200/80 dark:border-slate-800 p-6 transition-colors duration-300">
            <div class="flex flex-wrap justify-between items-start gap-4 mb-4">
                <div>
                    <span class="text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                        CHAMADO #{{ $ticket->id }}
                    </span>
                    <h1 class="text-xl font-bold text-slate-900 dark:text-white mt-0.5">
                        {{ $ticket->assunto }}
                    </h1>
                </div>

                <div class="flex items-center gap-2">
                    @php
                        $statusClasses = [
                            'Aberto' => 'bg-amber-100 text-amber-800 dark:bg-amber-950/60 dark:text-amber-300 border-amber-200 dark:border-amber-800/50',
                            'Em Andamento' => 'bg-blue-100 text-blue-800 dark:bg-blue-950/60 dark:text-blue-300 border-blue-200 dark:border-blue-800/50',
                            'Resolvido' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300 border-emerald-200 dark:border-emerald-800/50',
                        ];$classe = $statusClasses[$ticket->status] ?? 'bg-slate-100 text-slate-700';
                    @endphp
                    <span class="px-3 py-1 text-xs font-bold rounded-full border {{ $classe }}">
                        {{ $ticket->status }}
                    </span>

                    {{-- BOTÃO PARA O TÉCNICO ASSUMIR O CHAMADO --}}
                    @if(in_array(trim(strtolower(auth()->user()->tipo ?? '')), ['tecnico', 'admin']) && !$ticket->tecnico_id)
                        <form action="{{ route('tickets.assumir', $ticket->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="btn-star btn-star--indigo">
                                <div>
                                    <div>
                                        <div>🙋‍♂️ Assumir Chamado</div>
                                    </div>
                                </div>
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs py-3 px-4 bg-slate-50 dark:bg-slate-800/40 rounded-xl border border-slate-100 dark:border-slate-800 mb-4">
                <div>
                    <span class="font-semibold text-slate-500 dark:text-slate-400">Categoria:</span> 
                    <span class="text-slate-700 dark:text-slate-200 font-medium">{{ $ticket->categoria ?? 'Geral' }}</span>
                </div>
                <div>
                    <span class="font-semibold text-slate-500 dark:text-slate-400">Aberto por:</span> 
                    <span class="text-slate-700 dark:text-slate-200 font-medium">{{ $ticket->usuario_email }}</span>
                </div>
                <div>
                    <span class="font-semibold text-slate-500 dark:text-slate-400">Técnico Resp.:</span> 
                    <span class="text-indigo-600 dark:text-indigo-400 font-bold">
                        {{ $ticket->tecnico->name ?? 'Pendente' }}
                    </span>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1.5">
                    Descrição Inicial <span class="normal-case font-normal text-slate-400">• {{ $ticket->created_at->diffForHumans() }}</span>
                </label>
                <div class="p-4 bg-slate-50 dark:bg-slate-800/30 border border-slate-200/60 dark:border-slate-800 rounded-xl text-xs text-slate-700 dark:text-slate-300 leading-relaxed whitespace-pre-line">
                    {{ $ticket->descricao }}

                    {{-- Exibir Anexo Inicial do Ticket (se existir) --}}
                    @if($ticket->anexo)
                        <div class="mt-3 pt-3 border-t border-slate-200/50 dark:border-slate-700/50">
                            <span class="font-bold text-[10px] text-slate-400 uppercase block mb-1">📎 Anexo do Chamado:</span>
                            @if(\Illuminate\Support\Str::endsWith($ticket->anexo, ['.jpg', '.jpeg', '.png']))
                                <a href="{{ asset('storage/' . $ticket->anexo) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $ticket->anexo) }}" class="max-w-xs rounded-lg border border-slate-200 dark:border-slate-700 hover:opacity-90 transition">
                                </a>
                            @else
                                <a href="{{ asset('storage/' . $ticket->anexo) }}" target="_blank" class="inline-flex items-center gap-1.5 text-blue-600 dark:text-blue-400 hover:underline text-xs font-semibold">
                                    📄 Visualizar Documento Anexado
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            @if($ticket->status === 'Resolvido' && !empty($ticket->resposta))
                <div class="p-4 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 rounded-xl text-xs text-emerald-900 dark:text-emerald-200 mb-4">
                    <span class="font-bold flex items-center gap-1.5 mb-1 text-emerald-700 dark:text-emerald-400 uppercase tracking-wider text-[10px]">
                        <span>✅</span> Solução / Resposta Final do Suporte:
                    </span>
                    <p class="leading-relaxed whitespace-pre-line font-medium">{{ $ticket->resposta }}</p>
                </div>
            @endif

            {{-- AVALIAÇÃO DO ATENDIMENTO (Para o Cliente quando Resolvido) --}}
            @if($ticket->status === 'Resolvido' && (auth()->id() === $ticket->user_id || auth()->user()->email ===$ticket->usuario_email))
                <div class="p-4 bg-amber-50 dark:bg-amber-950/30 border border-amber-200 dark:border-amber-800/50 rounded-xl mb-4">
                    <h4 class="text-xs font-bold text-amber-900 dark:text-amber-200 mb-2">⭐ Avaliação do Atendimento</h4>
                    @if($ticket->avaliacao)
                        <p class="text-xs text-amber-700 dark:text-amber-300">
                            Sua nota para este atendimento: <strong>{{ $ticket->avaliacao }} / 5 Estrelas</strong>
                        </p>
                    @else
                        <form action="{{ route('tickets.avaliar', $ticket->id) }}" method="POST" class="flex items-center gap-3">
                            @csrf
                            <select name="avaliacao" class="px-3 py-1.5 bg-white dark:bg-slate-900 border border-amber-300 dark:border-amber-700 rounded-xl text-xs text-slate-800 dark:text-white outline-none">
                                <option value="5">⭐⭐⭐⭐⭐ Excelente (5)</option>
                                <option value="4">⭐⭐⭐⭐ Bom (4)</option>
                                <option value="3">⭐⭐⭐ Regular (3)</option>
                                <option value="2">⭐⭐ Ruim (2)</option>
                                <option value="1">⭐ Péssimo (1)</option>
                            </select>
                            <button type="submit" class="btn-star btn-star--amber btn-star--md">
                                <div>
                                    <div>
                                        <div>Enviar Avaliação</div>
                                    </div>
                                </div>
                            </button>
                        </form>
                    @endif
                </div>
            @endif

            {{-- PAINEL DO TÉCNICO --}}
            @if(in_array(trim(strtolower(auth()->user()->tipo ?? '')), ['tecnico', 'admin']))
                <div class="mt-6 pt-5 border-t border-slate-100 dark:border-slate-800">
                    <h3 class="text-xs font-bold text-slate-700 dark:text-slate-300 mb-3 flex items-center gap-1.5 uppercase tracking-wider">
                        🛠️ Painel do Técnico: Gerenciar Status
                    </h3>
                    <form action="{{ route('tickets.status', $ticket->id) }}" method="POST" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-end">
                        @csrf
                        <div class="sm:col-span-4">
                            <label class="block text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase mb-1">Status do Chamado</label>
                            <select name="status" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700 rounded-xl text-xs text-slate-800 dark:text-white outline-none focus:ring-2 focus:ring-blue-500 transition">
                                <option value="Aberto" {{ $ticket->status == 'Aberto' ? 'selected' : '' }}>Aberto</option>
                                <option value="Em Andamento" {{ $ticket->status == 'Em Andamento' ? 'selected' : '' }}>Em Andamento</option>
                                <option value="Resolvido" {{ $ticket->status == 'Resolvido' ? 'selected' : '' }}>Resolvido / Concluído</option>
                            </select>
                        </div>

                        <div class="sm:col-span-5">
                            <label class="block text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase mb-1">Resposta do Técnico (Opcional)</label>
                            <input type="text" name="resposta" value="{{ $ticket->resposta }}" placeholder="Descreva a solução do problema..." class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700 rounded-xl text-xs text-slate-800 dark:text-white outline-none focus:ring-2 focus:ring-blue-500 transition">
                        </div>

                        <div class="sm:col-span-3">
                            <button type="submit" class="btn-star btn-star--md btn-star--block">
                                <div>
                                    <div>
                                        <div>Atualizar Status</div>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </form>

                    {{-- PRIORIDADE E PRAZO (SLA) --}}
                    <form action="{{ route('tickets.prioridade', $ticket->id) }}" method="POST" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-end mt-4 pt-4 border-t border-slate-100 dark:border-slate-800">
                        @csrf
                        <div class="sm:col-span-4">
                            <label class="block text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase mb-1">Prioridade</label>
                            <select name="prioridade" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700 rounded-xl text-xs text-slate-800 dark:text-white outline-none focus:ring-2 focus:ring-blue-500 transition">
                                @foreach(\App\Models\Ticket::PRIORIDADES as $prioridade)
                                    <option value="{{ $prioridade }}" {{ $ticket->prioridade == $prioridade ? 'selected' : '' }}>{{ $prioridade }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="sm:col-span-5">
                            <span class="block text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase mb-1">Prazo de atendimento (SLA)</span>
                            <p class="py-2 text-xs font-semibold {{ $ticket->emAtraso() ? 'text-rose-600 dark:text-rose-400' : 'text-slate-600 dark:text-slate-300' }}">
                                {{ $ticket->slaHoras() }}h &bull;
                                {{ $ticket->status === 'Resolvido' ? 'Chamado resolvido' : $ticket->textoSla() }}
                            </p>
                        </div>

                        <div class="sm:col-span-3">
                            <button type="submit" class="btn-star btn-star--md btn-star--block">
                                <div>
                                    <div>
                                        <div>Salvar Prioridade</div>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
            @endif
        </div>

        {{-- HISTÓRICO DO CHAT --}}
        <div class="chat-container">
            <div class="chat-nav">
                <h2>💬 Histórico de Conversa</h2>
                <span class="chat-nav-id">CHAMADO #{{ $ticket->id }}</span>
            </div>

            {{-- Aviso mostrado quando o chamado muda (status/técnico) enquanto o usuário está digitando --}}
            <button type="button" id="aviso-atualizacao" onclick="window.location.reload()" class="hidden w-full text-center text-xs font-semibold py-2 bg-blue-600 text-white hover:bg-blue-500 transition">
                🔄 O chamado foi atualizado. Clique aqui para ver as novidades.
            </button>

            <div class="chat-messages" id="chat-messages"
                 data-url="{{ route('tickets.atualizacoes', $ticket->id) }}"
                 data-estado="{{ $ticket->assinaturaEstado() }}"
                 data-mensagens="{{ $ticket->assinaturaMensagens() }}">
                @include('tickets._mensagens')
            </div>

            {{-- FORMULÁRIO DO CHAT COM ANEXO --}}
            <form action="{{ route('tickets.mensagem', $ticket->id) }}" method="POST" enctype="multipart/form-data" class="chat-sender">
                @csrf

                {{-- ANEXO (mesmo input name="anexo", apenas novo estilo) --}}
                <label class="custum-file-upload">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z"></path></svg>
                    </div>
                    <div class="text">
                        <span data-file-label>Clique ou arraste para anexar prints / PDF</span>
                        <small>Imagens ou documentos</small>
                    </div>
                    <input type="file" name="anexo" title=" ">
                </label>

                <div class="chat-input-place">
                    <textarea name="mensagem" rows="2" placeholder="Digite aqui sua resposta..."></textarea>
                    <button type="submit" class="chat-send" title="Enviar mensagem" aria-label="Enviar mensagem">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" aria-hidden="true"><path d="M481.508,210.336L68.414,38.926c-17.403-7.222-37.064-4.045-51.309,8.287C2.86,59.547-3.098,78.551,1.558,96.808 L38.327,241h180.026c8.284,0,15.001,6.716,15.001,15.001c0,8.284-6.716,15.001-15.001,15.001H38.327L1.558,415.193 c-4.656,18.258,1.301,37.262,15.547,49.595c14.274,12.357,33.937,15.495,51.31,8.287l413.094-171.409 C500.317,293.862,512,276.364,512,256.001C512,235.638,500.317,218.139,481.508,210.336z"></path></svg>
                    </button>
                </div>
            </form>
        </div>

    </main>

    <script>
        const themeToggle = document.getElementById('theme-toggle');

        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            themeToggle.checked = true;
        } else {
            document.documentElement.classList.remove('dark');
            themeToggle.checked = false;
        }

        themeToggle.addEventListener('change', function() {
            if (themeToggle.checked) {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            }
        });

        // Upload estilizado: só mostra o nome do arquivo escolhido (não altera o envio)
        document.querySelectorAll('.custum-file-upload').forEach(function (box) {
            const input = box.querySelector('input[type="file"]');
            const label = box.querySelector('[data-file-label]');
            const original = label.textContent;

            input.addEventListener('change', function () {
                const name = input.files && input.files[0] ? input.files[0].name : '';
                label.textContent = name || original;
                box.classList.toggle('has-file', !!name);
            });

            ['dragenter', 'dragover'].forEach(function (evt) {
                box.addEventListener(evt, function () { box.classList.add('is-drag'); });
            });
            ['dragleave', 'drop'].forEach(function (evt) {
                box.addEventListener(evt, function () { box.classList.remove('is-drag'); });
            });
        });
        // Chat: abre já na mensagem mais recente (apenas visual)
        const chatMessages = document.getElementById('chat-messages');
        if (chatMessages) {
            chatMessages.style.scrollBehavior = 'auto';
            chatMessages.scrollTop = chatMessages.scrollHeight;
            chatMessages.style.scrollBehavior = '';
        }

        // Chat em tempo (quase) real: a cada 5s busca novidades sem recarregar a página.
        // - Mensagem nova: só troca a lista de mensagens (não mexe no que você está digitando).
        // - Status/técnico mudou: recarrega a página (ou avisa, se você estiver digitando).
        (function () {
            var box = document.getElementById('chat-messages');
            if (!box || !box.dataset.url) return;

            var url = box.dataset.url;
            var estado = box.dataset.estado;
            var mensagens = box.dataset.mensagens;
            var aviso = document.getElementById('aviso-atualizacao');
            var ocupado = false;
            var parado = false;

            function pertoDoFim() {
                return box.scrollHeight - box.scrollTop - box.clientHeight < 120;
            }

            function digitando() {
                var form = document.querySelector('.chat-sender');
                if (!form) return false;
                var texto = form.querySelector('textarea');
                var arquivo = form.querySelector('input[type="file"]');
                return (texto && texto.value.trim() !== '') || (arquivo && arquivo.files && arquivo.files.length > 0);
            }

            function buscar() {
                if (parado || ocupado || document.hidden) return;
                ocupado = true;

                fetch(url, {
                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                    credentials: 'same-origin',
                    cache: 'no-store'
                })
                .then(function (resp) {
                    // Sessão expirada ou sem permissão: para de consultar
                    if (resp.status === 401 || resp.status === 403 || resp.status === 404 || resp.status === 419) {
                        parado = true;
                        throw new Error('parado');
                    }
                    if (!resp.ok) throw new Error('erro');
                    return resp.json();
                })
                .then(function (dados) {
                    if (dados.estado !== estado) {
                        if (digitando()) {
                            if (aviso) aviso.classList.remove('hidden');
                        } else {
                            window.location.reload();
                        }
                        return;
                    }

                    if (dados.mensagens !== mensagens) {
                        var descer = pertoDoFim();
                        box.innerHTML = dados.html;
                        mensagens = dados.mensagens;
                        if (descer) box.scrollTop = box.scrollHeight;
                    }
                })
                .catch(function () { /* falha de rede: tenta de novo no próximo ciclo */ })
                .then(function () { ocupado = false; });
            }

            setInterval(buscar, 5000);
            document.addEventListener('visibilitychange', function () {
                if (!document.hidden) buscar();
            });
        })();
    </script>
</body>
</html>