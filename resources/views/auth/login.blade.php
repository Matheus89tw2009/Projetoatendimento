<!DOCTYPE html>
<html lang="pt-BR" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | MATHEUS SOLUTIONS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class' }
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
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-100 min-h-screen flex flex-col justify-between transition-colors duration-300">

    <!-- HEADER ESTILO SHADCN -->
    <header class="p-6 flex justify-between items-center max-w-6xl mx-auto w-full">
        <a href="/" class="flex items-center gap-2.5 font-bold text-base text-slate-900 dark:text-white">
            <span class="w-9 h-9 rounded-lg bg-slate-900 dark:bg-slate-100 dark:text-slate-900 flex items-center justify-center text-white text-sm font-extrabold shadow-sm">
                M
            </span>
            <span>MATHEUS <span class="text-blue-600 dark:text-blue-400">SOLUTIONS</span></span>
        </a>

        <!-- SWITCH DE TEMA -->
        <label class="switch" title="Alternar tema" aria-label="Alternar tema claro/escuro">
            <input type="checkbox" id="theme-toggle">
            <span class="slider"></span>
        </label>
    </header>

    <!-- CONTEÚDO PRINCIPAL (CARD SHADCN) -->
    <main class="w-full max-w-md mx-auto px-4 py-8">
        <div class="bg-white dark:bg-slate-900 rounded-xl p-8 shadow-sm border border-slate-200 dark:border-slate-800 transition-colors duration-300">
            
            <div class="space-y-1 mb-6 text-center">
                <h1 class="text-xl font-semibold tracking-tight text-slate-900 dark:text-white">Acesse sua Conta</h1>
                <p class="text-xs text-slate-500 dark:text-slate-400">Entre com suas credenciais para gerenciar os chamados</p>
            </div>

            @if(session('erro'))
                <div class="mb-4 p-3 bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-900 rounded-lg text-rose-700 dark:text-rose-300 text-xs font-medium">
                    ⚠️ {{ session('erro') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-3 bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-900 rounded-lg text-rose-700 dark:text-rose-300 text-xs font-medium space-y-1">
                    @foreach($errors->all() as $error)
                        <p>⚠️ {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            {{-- FORMULÁRIO (Lógica mantida idêntica apontando para /login) --}}
            <form action="/login" method="POST" class="space-y-4">
                @csrf
                
                <div class="space-y-2">
                    <label class="block text-xs font-medium text-slate-900 dark:text-slate-200">E-mail</label>
                    <input type="email" name="email" required placeholder="Digite seu e-mail" autocomplete="off" class="flex h-9 w-full rounded-md border border-slate-200 dark:border-slate-800 bg-transparent px-3 py-1 text-xs shadow-sm transition-colors file:border-0 file:bg-transparent file:text-xs file:font-medium placeholder:text-slate-400 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-slate-900 dark:focus-visible:ring-slate-300">
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-medium text-slate-900 dark:text-slate-200">Senha</label>
                    <input type="password" name="password" required placeholder="••••••••" class="flex h-9 w-full rounded-md border border-slate-200 dark:border-slate-800 bg-transparent px-3 py-1 text-xs shadow-sm transition-colors file:border-0 file:bg-transparent file:text-xs file:font-medium placeholder:text-slate-400 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-slate-900 dark:focus-visible:ring-slate-300">
                </div>

                <button type="submit" class="btn-star btn-star--primary btn-star--block">
                    <div>
                        <div>
                            <div>Entrar no Sistema</div>
                        </div>
                    </div>
                </button>
            </form>

            <div class="mt-6 text-center border-t border-slate-100 dark:border-slate-800/80 pt-4">
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    Ainda não tem conta? 
                    <a href="/register" class="text-slate-900 dark:text-white font-medium underline underline-offset-4 hover:opacity-80">Cadastre-se</a>
                </p>
            </div>

        </div>
    </main>

    <!-- FOOTER -->
    <footer class="py-6 text-center text-xs text-slate-400 dark:text-slate-600">
        © {{ date('Y') }} MATHEUS SOLUTIONS. Todos os direitos reservados.
    </footer>

    <!-- SCRIPT DO TEMA -->
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
    </script>
</body>
</html>