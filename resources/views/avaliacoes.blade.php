<!DOCTYPE html>
<html lang="pt-BR" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliações dos Clientes | Helpdesk</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-100 min-h-screen pb-12 transition-colors duration-300 selection:bg-blue-600 selection:text-white">

    <!-- NAVBAR COM GLASSMORPHISM SUTIL -->
    <nav class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border-b border-slate-200/80 dark:border-slate-800/80 sticky top-0 z-20 transition-colors duration-300 shadow-2xs">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-amber-500/10 dark:bg-amber-500/20 text-amber-600 dark:text-amber-400 border border-amber-500/20 flex items-center justify-center font-bold text-sm shadow-2xs">
                        ⭐
                    </div>
                    <div>
                        <h1 class="font-bold text-slate-900 dark:text-white text-sm leading-tight">Helpdesk</h1>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400">Histórico de Avaliações</p>
                    </div>
                </div>

                <div class="flex items-center gap-2.5">
                    <a href="/painel" class="px-3.5 py-1.5 text-xs font-semibold text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-800 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg transition border border-slate-200 dark:border-slate-700 shadow-2xs flex items-center gap-1.5">
                        ⬅️ Voltar ao Painel
                    </a>

                    <button id="theme-toggle" type="button" class="w-9 h-9 rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 flex items-center justify-center transition shadow-2xs">
                        <span id="theme-toggle-dark-icon" class="hidden text-xs">🌙</span>
                        <span id="theme-toggle-light-icon" class="hidden text-xs">☀️</span>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">

        <div class="bg-white dark:bg-slate-900 rounded-xl shadow-2xs border border-slate-200/80 dark:border-slate-800 overflow-hidden transition-colors duration-300">
            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-slate-50/50 dark:bg-slate-900/50">
                <h3 class="font-bold text-slate-900 dark:text-white text-xs uppercase tracking-wider flex items-center gap-2">
                    ⭐ Chamados Avaliados pelos Clientes
                </h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200/60 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/80 text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                            <th class="py-3.5 px-6">#ID</th>
                            <th class="py-3.5 px-6">Assunto</th>
                            <th class="py-3.5 px-6">Cliente</th>
                            <th class="py-3.5 px-6">Nota</th>
                            <th class="py-3.5 px-6 text-center">Ação</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 text-xs">
                        @forelse($ticketsAvaliados as $ticket)
                        <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/40 transition">
                            <td class="py-4 px-6 font-mono font-bold text-slate-400">#{{ $ticket->id }}</td>
                            <td class="py-4 px-6 font-semibold text-slate-900 dark:text-white">
                                {{ $ticket->assunto }}
                            </td>
                            <td class="py-4 px-6 text-slate-500 dark:text-slate-400 text-[11px]">
                                {{ $ticket->usuario_email }}
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-amber-50 dark:bg-amber-950/40 text-amber-700 dark:text-amber-400 border border-amber-200/80 dark:border-amber-900/60 font-semibold rounded-full text-[11px] shadow-2xs">
                                    {{ str_repeat('⭐', $ticket->avaliacao) }} <span class="font-mono text-[10px] opacity-80">({{ $ticket->avaliacao }}/5)</span>
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <a href="{{ route('tickets.show', $ticket->id) }}" class="inline-flex items-center gap-1.5 bg-slate-100 dark:bg-slate-800 hover:bg-blue-600 hover:text-white text-slate-700 dark:text-slate-300 px-3 py-1.5 rounded-lg text-xs font-semibold transition border border-slate-200 dark:border-slate-700/80 shadow-2xs">
                                    🔍 Ver Detalhes
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-slate-400 dark:text-slate-600">
                                <div class="flex flex-col items-center justify-center gap-1.5">
                                    <span class="text-2xl">📋</span>
                                    <p class="text-xs font-medium">Nenhuma avaliação registrada até o momento.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <script>
        const themeToggleBtn = document.getElementById('theme-toggle');
        const darkIcon = document.getElementById('theme-toggle-dark-icon');
        const lightIcon = document.getElementById('theme-toggle-light-icon');

        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            lightIcon.classList.remove('hidden');
        } else {
            document.documentElement.classList.remove('dark');
            darkIcon.classList.remove('hidden');
        }

        themeToggleBtn.addEventListener('click', function() {
            darkIcon.classList.toggle('hidden');
            lightIcon.classList.toggle('hidden');

            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        });
    </script>
</body>
</html>