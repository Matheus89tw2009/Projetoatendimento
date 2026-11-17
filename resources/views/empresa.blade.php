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

        /* Animações CSS Personalizadas */
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
<body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-100 min-h-screen transition-colors duration-300">

    <header class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 sticky top-0 z-30 transition-colors duration-300">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-4 flex justify-between items-center">
            
            <a href="/" class="flex items-center gap-2 font-extrabold text-lg tracking-tight text-slate-900 dark:text-white group">
                <span class="w-9 h-9 rounded-xl bg-blue-600 flex items-center justify-center text-white text-base font-black shadow-md shadow-blue-500/20 group-hover:scale-105 transition-transform duration-300">
                    M
                </span>
                <span>MATHEUS <span class="text-blue-600 dark:text-blue-400">SOLUTIONS</span></span>
            </a>

            <div class="flex items-center gap-3">
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
                    <a href="/login" class="text-slate-600 dark:text-slate-300 hover:text-blue-600 text-xs font-bold px-3 py-2 transition-colors duration-300">
                        Entrar
                    </a>
                    <a href="/register" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-xl text-xs transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-0.5">
                        Criar Conta
                    </a>
                @endauth
            </div>

        </div>
    </header>

    <section class="max-w-6xl mx-auto px-4 sm:px-6 pt-16 pb-20 text-center">
        <div class="opacity-0 animate-fade-in-up">
            <span class="inline-block px-3 py-1 bg-blue-50 dark:bg-blue-950/60 border border-blue-200 dark:border-blue-800/60 text-blue-700 dark:text-blue-300 text-xs font-bold rounded-full mb-6 animate-pulse">
                🚀 Plataforma Inteligente de Suporte Tecnológico
            </span>
        </div>

        <h1 class="opacity-0 animate-fade-in-up animation-delay-100 text-3xl sm:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight max-w-3xl mx-auto">
            Soluções ágeis e suporte simplificado para sua empresa.
        </h1>

        <p class="opacity-0 animate-fade-in-up animation-delay-200 text-sm sm:text-base text-slate-600 dark:text-slate-400 mt-4 max-w-2xl mx-auto leading-relaxed">
            Na <strong class="text-slate-800 dark:text-slate-200">MATHEUS SOLUTIONS</strong>, gerenciamos chamados técnicos com rapidez, transparência e um sistema interativo em tempo real.
        </p>

        <div class="opacity-0 animate-fade-in-up animation-delay-300 mt-8 flex flex-wrap justify-center gap-4">
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
            <a href="#recursos" id="btn-recursos" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 font-bold px-6 py-3.5 rounded-2xl text-xs transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                Conhecer Recursos
            </a>
        </div>
    </section>

    <section id="recursos" class="max-w-6xl mx-auto px-4 sm:px-6 py-12 border-t border-slate-200/60 dark:border-slate-800 opacity-0 animate-fade-in-up animation-delay-400">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-200/80 dark:border-slate-800 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 group">
                <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold text-lg mb-4 group-hover:scale-110 transition-transform duration-300">
                    ⚡
                </div>
                <h3 class="font-bold text-slate-900 dark:text-white text-base mb-2">Atendimento Rápido</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                    Acompanhe em tempo real a evolução do seu ticket desde a abertura até a solução final.
                </p>
            </div>

            <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-200/80 dark:border-slate-800 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 group">
                <div class="w-10 h-10 rounded-xl bg-purple-100 dark:bg-purple-950/60 text-purple-600 dark:text-purple-400 flex items-center justify-center font-bold text-lg mb-4 group-hover:scale-110 transition-transform duration-300">
                    💬
                </div>
                <h3 class="font-bold text-slate-900 dark:text-white text-base mb-2">Chat Integrado</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                    Converse diretamente com o técnico responsável pelo seu chamado através do nosso chat exclusivo.
                </p>
            </div>

            <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-200/80 dark:border-slate-800 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 group">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold text-lg mb-4 group-hover:scale-110 transition-transform duration-300">
                    🛡️
                </div>
                <h3 class="font-bold text-slate-900 dark:text-white text-base mb-2">Segurança & Controle</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                    Histórico completo de interações, controle anti-spam e permissões isoladas para clientes e técnicos.
                </p>
            </div>

        </div>
    </section>

    <footer class="bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 py-8 mt-12 transition-colors duration-300">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">
                © {{ date('Y') }} MATHEUS SOLUTIONS. Todos os direitos reservados.
            </p>
        </div>
    </footer>

    <script>
        // Alternância do Tema Escuro/Claro
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

        // Script para força da Rolagem Suave até a seção #recursos
        document.getElementById('btn-recursos')?.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.getElementById('recursos');
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    </script>
</body>
</html>