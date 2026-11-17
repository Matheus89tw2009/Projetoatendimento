<!DOCTYPE html>
<html lang="pt-BR" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta | MATHEUS SOLUTIONS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class' }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .animation-delay-100 { animation-delay: 0.1s; }

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

    <header class="p-4 sm:p-6 flex justify-between items-center max-w-6xl mx-auto w-full">
        <a href="/" class="flex items-center gap-2 font-extrabold text-lg tracking-tight text-slate-900 dark:text-white group">
            <span class="w-9 h-9 rounded-xl bg-blue-600 flex items-center justify-center text-white text-base font-black shadow-md shadow-blue-500/20 group-hover:scale-105 transition-transform duration-300">
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

    <main class="w-full max-w-md mx-auto px-4 py-8">
        <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 sm:p-8 shadow-xl border border-slate-200/80 dark:border-slate-800 transition-all duration-300 opacity-0 animate-fade-in-up">
            
            <div class="text-center mb-6">
                <span class="inline-block px-3 py-1 bg-blue-50 dark:bg-blue-950/60 border border-blue-200 dark:border-blue-800/60 text-blue-700 dark:text-blue-300 text-[10px] font-bold rounded-full mb-3 animate-pulse">
                    ✨ Novo Usuário
                </span>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Criar Nova Conta</h1>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Cadastre-se para abrir e acompanhar seus chamados</p>
            </div>

            @if ($errors->any())
                <div class="mb-5 p-3.5 bg-rose-50 dark:bg-rose-950/50 border-l-4 border-rose-500 rounded-r-xl text-rose-700 dark:text-rose-300 text-xs font-semibold space-y-1">
                    @foreach ($errors->all() as $error)
                        <p>⚠️ {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-[11px] font-bold uppercase text-slate-500 dark:text-slate-400 mb-1.5">Nome Completo</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Seu nome completo" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl text-xs text-slate-900 dark:text-white outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200">
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase text-slate-500 dark:text-slate-400 mb-1.5">E-mail</label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="seu@email.com" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl text-xs text-slate-900 dark:text-white outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200">
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase text-slate-500 dark:text-slate-400 mb-1.5">Senha</label>
                    <input type="password" name="password" required placeholder="••••••••" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl text-xs text-slate-900 dark:text-white outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200">
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase text-slate-500 dark:text-slate-400 mb-1.5">Confirmar Senha</label>
                    <input type="password" name="password_confirmation" required placeholder="••••••••" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl text-xs text-slate-900 dark:text-white outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200">
                </div>

                <button type="submit" class="btn-star btn-star--primary btn-star--block group">
                    <div>
                        <div>
                            <div>
                                <span>Cadastrar Conta</span>
                                <span class="group-hover:translate-x-1 transition-transform duration-300">➔</span>
                            </div>
                        </div>
                    </div>
                </button>
            </form>

            <div class="mt-6 text-center border-t border-slate-100 dark:border-slate-800 pt-5">
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    Já tem uma conta? 
                    <a href="/login" class="text-blue-600 dark:text-blue-400 font-bold hover:underline">Faça login aqui</a>
                </p>
            </div>

        </div>
    </main>

    <footer class="py-6 text-center text-xs text-slate-400 dark:text-slate-600">
        © {{ date('Y') }} MATHEUS SOLUTIONS. Todos os direitos reservados.
    </footer>

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