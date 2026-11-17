<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helpdesk - Atendimento ao Cliente</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        dark: {
                            bg: '#0B0F17',
                            card: '#111827',
                            border: '#1F2937',
                            input: '#1F2937',
                            text: '#F9FAFB'
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#0B0F17] text-gray-100 min-h-screen font-sans antialiased">

    @php
        // Define qual aba está ativa (padrão é 'novo' se for cliente, ou 'chamados' se for técnico/admin)
        $abaAtiva = request('aba', in_array(trim(strtolower($user->tipo ?? '')), ['tecnico', 'admin']) ? 'chamados' : 'novo');
    @endphp

    <header class="border-b border-gray-800 bg-[#111827] px-6 py-4 flex flex-wrap items-center justify-between gap-4">
        
        <a href="/" class="flex items-center gap-3 group transition">
            <div class="w-10 h-10 rounded-lg bg-blue-600 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-blue-500/30 group-hover:bg-blue-500 transition">
                <i class="fa-solid fa-ticket"></i>
            </div>
            <div>
                <h1 class="text-lg font-bold leading-none text-white group-hover:text-blue-400 transition">Helpdesk</h1>
                <span class="text-xs text-gray-400">Atendimento ao Cliente</span>
            </div>
        </a>

        <div class="flex flex-wrap items-center gap-3">
            
            @if(in_array(trim(strtolower($user->tipo ?? '')), ['tecnico', 'admin']))
                <a href="/avaliacoes" class="px-3.5 py-2 bg-amber-500/10 text-amber-400 border border-amber-500/30 rounded-lg text-xs font-semibold hover:bg-amber-500/20 transition flex items-center gap-2">
                    <i class="fa-solid fa-star"></i> Avaliações
                </a>
            @endif

            @if(!in_array(trim(strtolower($user->tipo ?? '')), ['tecnico', 'admin']))
                <a href="?aba=novo" class="px-3.5 py-2 rounded-lg text-xs font-bold transition flex items-center gap-2 {{ $abaAtiva == 'novo' ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30' : 'bg-gray-800 text-gray-300 hover:bg-gray-700' }}">
                    <i class="fa-solid fa-plus-circle"></i> Novo Chamado
                </a>
            @endif

            <a href="?aba=chamados" class="px-3.5 py-2 rounded-lg text-xs font-bold transition flex items-center gap-2 {{ $abaAtiva == 'chamados' ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30' : 'bg-gray-800 text-gray-300 hover:bg-gray-700' }}">
                <i class="fa-solid fa-list-check"></i> Meus Chamados
            </a>

            <div class="flex items-center gap-2 bg-gray-800/60 px-3 py-1.5 rounded-lg border border-gray-700/50">
                <div class="text-right">
                    <p class="text-xs font-semibold text-gray-200">{{ $user->name ?? 'Usuário' }}</p>
                    <span class="text-[10px] uppercase font-bold text-purple-400 bg-purple-500/20 px-1.5 py-0.5 rounded">
                        {{ $user->tipo ?? 'Cliente' }}
                    </span>
                </div>
            </div>

            <form action="/logout" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-3 py-1.5 bg-red-500/20 text-red-400 hover:bg-red-500/30 border border-red-500/30 rounded-lg text-xs font-bold transition">
                    Sair
                </button>
            </form>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-8 space-y-6">

        @if(session('sucesso'))
            <div class="p-4 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 rounded-xl text-sm font-medium flex items-center gap-2">
                <i class="fa-solid fa-circle-check"></i> {{ session('sucesso') }}
            </div>
        @endif

        @if(session('erro'))
            <div class="p-4 bg-rose-500/10 border border-rose-500/30 text-rose-400 rounded-xl text-sm font-medium flex items-center gap-2">
                <i class="fa-solid fa-triangle-exclamation"></i> {{ session('erro') }}
            </div>
        @endif

        @if($abaAtiva == 'novo' && !in_array(trim(strtolower($user->tipo ?? '')), ['tecnico', 'admin']))
            <div class="bg-[#111827] border border-gray-800 rounded-2xl p-6 shadow-xl">
                <h2 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-wand-magic-sparkles text-blue-400"></i> Novo Chamado
                </h2>

                <form action="/tickets" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-1">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Assunto</label>
                            <input type="text" name="assunto" required placeholder="Ex: Problema no acesso ao sistema" class="w-full bg-gray-900 border border-gray-800 rounded-xl px-4 py-3 text-sm text-gray-200 focus:outline-none focus:border-blue-500 transition">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Categoria</label>
                            <select name="categoria" id="categoria_select" required onchange="atualizarSubcategorias()" class="w-full bg-gray-900 border border-gray-800 rounded-xl px-4 py-3 text-sm text-gray-200 focus:outline-none focus:border-blue-500 transition">
                                <option value="">Selecione...</option>
                                <option value="Suporte Técnico">Suporte Técnico</option>
                                <option value="RH">RH</option>
                                <option value="Financeiro">Financeiro</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Subcategoria</label>
                            <select name="subcategoria" id="subcategoria_select" class="w-full bg-gray-900 border border-gray-800 rounded-xl px-4 py-3 text-sm text-gray-200 focus:outline-none focus:border-blue-500 transition">
                                <option value="">Selecione uma categoria primeiro</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Descrição</label>
                        <textarea name="descricao" rows="4" required placeholder="Detalhamento do ocorrido..." class="w-full bg-gray-900 border border-gray-800 rounded-xl p-4 text-sm text-gray-200 focus:outline-none focus:border-blue-500 transition"></textarea>
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Anexo (Prints/PDF - Opcional)</label>
                            <input type="file" name="anexo" class="text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-gray-800 file:text-blue-400 hover:file:bg-gray-700">
                        </div>

                        <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm rounded-xl transition shadow-lg shadow-blue-600/30">
                            Enviar Ticket
                        </button>
                    </div>
                </form>
            </div>
        @endif

        @if($abaAtiva == 'chamados')
            {{-- Filtros: visíveis apenas para técnico/admin --}}
            @if(in_array(trim(strtolower($user->tipo ?? '')), ['tecnico', 'admin']))
            <div class="bg-[#111827] border border-gray-800 rounded-2xl p-4 flex flex-wrap gap-3 items-center justify-between">
                <form action="/painel" method="GET" class="flex flex-wrap items-center gap-3 w-full">
                    <input type="hidden" name="aba" value="chamados">
                    
                    <div class="flex-1 min-w-[200px]">
                        <input type="text" name="busca" value="{{ request('busca') }}" placeholder="🔍 Buscar por ID ou Assunto..." class="w-full bg-gray-900 border border-gray-800 rounded-xl px-4 py-2 text-sm text-gray-200 focus:outline-none focus:border-blue-500">
                    </div>

                    <select name="status" class="bg-gray-900 border border-gray-800 rounded-xl px-4 py-2 text-sm text-gray-200">
                        <option value="todos">Todos os Status</option>
                        <option value="Aberto" {{ request('status') == 'Aberto' ? 'selected' : '' }}>Aberto</option>
                        <option value="Em Andamento" {{ request('status') == 'Em Andamento' ? 'selected' : '' }}>Em Andamento</option>
                        <option value="Resolvido" {{ request('status') == 'Resolvido' ? 'selected' : '' }}>Resolvido</option>
                    </select>

                    <select name="categoria" class="bg-gray-900 border border-gray-800 rounded-xl px-4 py-2 text-sm text-gray-200">
                        <option value="todas">Todas as Categorias</option>
                        <option value="Suporte Técnico" {{ request('categoria') == 'Suporte Técnico' ? 'selected' : '' }}>Suporte Técnico</option>
                        <option value="RH" {{ request('categoria') == 'RH' ? 'selected' : '' }}>RH</option>
                        <option value="Financeiro" {{ request('categoria') == 'Financeiro' ? 'selected' : '' }}>Financeiro</option>
                    </select>

                    <button type="submit" class="px-5 py-2 bg-gray-800 hover:bg-gray-700 text-gray-200 font-bold text-sm rounded-xl transition">
                        Filtrar
                    </button>
                </form>
            </div>
            @endif

            <div class="bg-[#111827] border border-gray-800 rounded-2xl overflow-hidden shadow-xl">
                <div class="p-4 border-b border-gray-800 font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-list-check text-gray-400"></i> Chamados Ativos
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-300">
                        <thead class="bg-gray-900/50 text-xs uppercase font-bold text-gray-400 border-b border-gray-800">
                            <tr>
                                <th class="p-4">#ID</th>
                                <th class="p-4">Assunto</th>
                                <th class="p-4">Categoria / Subcategoria</th>
                                <th class="p-4">Cliente</th>
                                <th class="p-4">Aberto Há</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-center w-12"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800/50">
                            @forelse($tickets as $ticket)
                                <tr class="group cursor-pointer hover:bg-gray-800/30 transition"
                                    role="link" tabindex="0"
                                    onclick="window.location.href='/tickets/{{ $ticket->id }}'"
                                    onkeydown="if (event.key === 'Enter') { window.location.href='/tickets/{{ $ticket->id }}'; }">
                                    <td class="p-4 font-mono font-bold text-blue-400">#{{ $ticket->id }}</td>
                                    <td class="p-4 font-semibold text-white">{{ $ticket->assunto }}</td>
                                    <td class="p-4">
                                        <span class="text-xs bg-gray-800 text-gray-300 px-2 py-1 rounded">
                                            {{ $ticket->categoria }}
                                        </span>
                                        @if($ticket->subcategoria)
                                            <span class="text-[11px] text-gray-400 block mt-1">
                                                ↳ {{ $ticket->subcategoria }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-xs text-gray-400">{{ $ticket->usuario_email }}</td>
                                    <td class="p-4 text-xs text-gray-400">{{ $ticket->created_at->diffForHumans() }}</td>
                                    <td class="p-4">
                                        @if($ticket->status == 'Aberto')
                                            <span class="px-2.5 py-1 bg-amber-500/10 text-amber-400 border border-amber-500/20 rounded-full text-xs font-bold">Aberto</span>
                                        @elseif($ticket->status == 'Em Andamento')
                                            <span class="px-2.5 py-1 bg-blue-500/10 text-blue-400 border border-blue-500/20 rounded-full text-xs font-bold">Em Andamento</span>
                                        @else
                                            <span class="px-2.5 py-1 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 rounded-full text-xs font-bold">Resolvido</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-center">
                                        <a href="/tickets/{{ $ticket->id }}" aria-label="Abrir chamado #{{ $ticket->id }}" class="text-gray-600 group-hover:text-blue-400 transition">
                                            <i class="fa-solid fa-chevron-right"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-8 text-center text-gray-500">
                                        Nenhum chamado encontrado.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

    </main>

    <script>
        const subcategorias = {
            'Suporte Técnico': ['Computador / Hardware', 'Internet / Rede', 'Sistemas / Login', 'Outros'],
            'RH': ['Folha de Pagamento', 'Férias', 'Benefícios', 'Dúvidas Gerais'],
            'Financeiro': ['Segunda Via de Boleto', 'Notas Fiscais', 'Reembolso', 'Outros']
        };

        function atualizarSubcategorias() {
            const catSelect = document.getElementById('categoria_select');
            const subSelect = document.getElementById('subcategoria_select');
            const catSelecionada = catSelect.value;

            subSelect.innerHTML = '<option value="">Selecione...</option>';

            if (catSelecionada && subcategorias[catSelecionada]) {
                subcategorias[catSelecionada].forEach(sub => {
                    const option = document.createElement('option');
                    option.value = sub;
                    option.textContent = sub;
                    subSelect.appendChild(option);
                });
            } else {
                subSelect.innerHTML = '<option value="">Selecione uma categoria primeiro</option>';
            }
        }
    </script>
</body>
</html>