<!DOCTYPE html>
<html lang="pt-BR" class="light scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MATHEUS SOLUTIONS | Suporte TI e Chamados</title>
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
                transform: translateY(16px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .animation-delay-100 { animation-delay: 0.1s; }
        .animation-delay-200 { animation-delay: 0.2s; }
        .animation-delay-300 { animation-delay: 0.3s; }
        .animation-delay-400 { animation-delay: 0.4s; }

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
<body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-100 min-h-screen transition-colors duration-300 flex flex-col justify-between selection:bg-blue-600 selection:text-white">

    <!-- HEADER COM GLASSMORPHISM SUTIL -->
    <header class="bg-white/70 dark:bg-slate-900/70 backdrop-blur-xl border-b border-slate-200/80 dark:border-slate-800/80 sticky top-0 z-30 transition-colors">
        <div class="max-w-6xl mx-auto px-6 h-16 flex justify-between items-center">
            
            <a href="/" class="flex items-center gap-2.5 font-bold text-sm tracking-tight text-slate-900 dark:text-white group">
                <span class="w-8 h-8 rounded-lg bg-slate-900 dark:bg-slate-100 text-white dark:text-slate-900 flex items-center justify-center text-xs font-black shadow-sm group-hover:scale-105 transition-transform">
                    M
                </span>
                <span>MATHEUS <span class="text-blue-600 dark:text-blue-400">SOLUTIONS</span></span>
            </a>

            <div class="flex items-center gap-2.5">
                <!-- SWITCH DE TEMA -->
                <label class="switch" title="Alternar tema" aria-label="Alternar tema claro/escuro">
                    <input type="checkbox" id="theme-toggle">
                    <span class="slider"></span>
                </label>

                @auth
                    <a href="/painel" class="btn-star">
                        <div>
                            <div>
                                <div>Acessar Painel ➔</div>
                            </div>
                        </div>
                    </a>
                @else
                    <a href="/login" class="text-xs font-medium text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white px-3 py-2 transition-colors">
                        Entrar
                    </a>
                    <a href="/register" class="inline-flex items-center justify-center rounded-lg text-xs font-medium transition-colors bg-blue-600 text-white h-9 px-4 shadow-sm hover:bg-blue-700">
                        Criar Conta
                    </a>
                @endauth
            </div>

        </div>
    </header>

    <!-- CONTEÚDO HERO -->
    <main class="flex-1">
        <section class="max-w-5xl mx-auto px-6 pt-20 pb-16 text-center">
            <div class="opacity-0 animate-fade-in-up">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-blue-50 dark:bg-blue-950/50 text-blue-700 dark:text-blue-300 border border-blue-200/60 dark:border-blue-900/60 mb-6 shadow-2xs">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600 dark:bg-blue-400 animate-pulse"></span>
                    Plataforma Inteligente de Suporte Tecnológico
                </span>
            </div>

            <h1 class="opacity-0 animate-fade-in-up animation-delay-100 text-3xl sm:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-[1.15] max-w-2xl mx-auto">
                Soluções ágeis e suporte simplificado para sua empresa.
            </h1>

            <p class="opacity-0 animate-fade-in-up animation-delay-200 text-sm sm:text-base text-slate-500 dark:text-slate-400 mt-5 max-w-xl mx-auto leading-relaxed font-normal">
                Na <strong class="text-slate-800 dark:text-slate-200 font-semibold">MATHEUS SOLUTIONS</strong>, gerenciamos chamados técnicos com rapidez, transparência e um sistema interativo em tempo real.
            </p>

            <div class="opacity-0 animate-fade-in-up animation-delay-300 mt-8 flex flex-wrap justify-center gap-3">
                <a href="/login" class="btn-star btn-star--primary group">
                    <div>
                        <div>
                            <div>
                                <span>Abrir um Chamado Agora</span>
                                <span class="group-hover:translate-x-1 transition-transform duration-300">➔</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#recursos" id="btn-recursos" class="inline-flex items-center justify-center rounded-xl text-xs font-semibold transition-all bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 h-10 px-5 shadow-sm hover:bg-slate-50 dark:hover:bg-slate-800">
                    Conhecer Recursos
                </a>
            </div>
        </section>

        <!-- SEÇÃO DE RECURSOS -->
        <section id="recursos" class="max-w-6xl mx-auto px-6 py-12 border-t border-slate-200/60 dark:border-slate-800/80 opacity-0 animate-fade-in-up animation-delay-400 mb-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                
                <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-2xs hover:border-slate-300 dark:hover:border-slate-700 transition-all group">
                    <div class="w-10 h-10 rounded-lg bg-blue-50 dark:bg-blue-950/50 text-blue-600 dark:text-blue-400 flex items-center justify-center text-base font-bold mb-4 group-hover:scale-105 transition-transform">
                        ⚡
                    </div>
                    <h3 class="font-semibold text-slate-900 dark:text-white text-sm mb-1.5">Atendimento Rápido</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                        Acompanhe em tempo real a evolução do seu ticket desde a abertura até a solução final.
                    </p>
                </div>

                <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-2xs hover:border-slate-300 dark:hover:border-slate-700 transition-all group">
                    <div class="w-10 h-10 rounded-lg bg-purple-50 dark:bg-purple-950/50 text-purple-600 dark:text-purple-400 flex items-center justify-center text-base font-bold mb-4 group-hover:scale-105 transition-transform">
                        💬
                    </div>
                    <h3 class="font-semibold text-slate-900 dark:text-white text-sm mb-1.5">Chat Integrado</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                        Converse diretamente com o técnico responsável pelo seu chamado através do nosso chat exclusivo.
                    </p>
                </div>

                <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-2xs hover:border-slate-300 dark:hover:border-slate-700 transition-all group">
                    <div class="w-10 h-10 rounded-lg bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-base font-bold mb-4 group-hover:scale-105 transition-transform">
                        🛡️
                    </div>
                    <h3 class="font-semibold text-slate-900 dark:text-white text-sm mb-1.5">Segurança & Controle</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                        Histórico completo de interações, controle anti-spam e permissões isoladas para clientes e técnicos.
                    </p>
                </div>

            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <footer class="bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 py-6 transition-colors">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <p class="text-xs text-slate-400 dark:text-slate-500 font-medium">
                © {{ date('Y') }} MATHEUS SOLUTIONS. Todos os direitos reservados.
            </p>
        </div>
    </footer>

    <script>
        const themeToggle = document.getElementById('theme-toggle');

        const isDark =
            localStorage.getItem('color-theme') === 'dark' ||
            (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);

        document.documentElement.classList.toggle('dark', isDark);
        themeToggle.checked = isDark;

        themeToggle.addEventListener('change', function () {
            const dark = themeToggle.checked;
            document.documentElement.classList.toggle('dark', dark);
            localStorage.setItem('color-theme', dark ? 'dark' : 'light');
        });

        document.getElementById('btn-recursos')?.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.getElementById('recursos');
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    </script>
</body>
</html>