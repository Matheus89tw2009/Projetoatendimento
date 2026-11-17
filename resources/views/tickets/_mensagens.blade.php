{{-- Mensagens do chat. Usado pela tela do chamado e pela atualização automática (rota tickets.atualizacoes). --}}
                @forelse($ticket->comments ?? $ticket->mensagens ?? [] as $msg)
                    @php
                        $isMe = ($msg->user_id ?? null) === auth()->id();
                        $isTecnico = strtolower($msg->user->tipo ?? '') === 'tecnico';
                    @endphp

                    <div class="chat-row">
                    <div class="flex flex-col {{ $isMe ? 'items-end' : 'items-start' }}">
                        <div class="flex items-center gap-2 text-[10px] text-slate-400 dark:text-slate-500 mb-1 px-1">
                            <span class="font-bold text-slate-600 dark:text-slate-300">{{ $msg->user->name ?? 'Usuário' }}</span>
                            <span>•</span>
                            <span class="px-1.5 py-0.2 rounded font-semibold {{ $isTecnico ? 'bg-purple-100 text-purple-700 dark:bg-purple-950/60 dark:text-purple-300' : 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400' }}">
                                {{ $isTecnico ? 'Técnico' : 'Cliente' }}
                            </span>
                            <span>•</span>
                            <span>{{ $msg->created_at ? $msg->created_at->diffForHumans() : '' }}</span>
                        </div>

                        <div class="max-w-[85%] p-3.5 rounded-2xl text-xs leading-relaxed {{ $isMe ? 'bg-blue-600 text-white rounded-tr-none shadow-sm' : 'bg-slate-100 dark:bg-slate-800/80 text-slate-800 dark:text-slate-200 rounded-tl-none border border-slate-200/50 dark:border-slate-700/50' }}">
                            {{ $msg->mensagem }}

                            {{-- EXIBIÇÃO DE ANEXO NO CHAT --}}
                            @if($msg->anexo)
                                <div class="mt-2 pt-2 border-t border-white/20">
                                    @if(\Illuminate\Support\Str::endsWith($msg->anexo, ['.jpg', '.jpeg', '.png']))
                                        <a href="{{ asset('storage/' . $msg->anexo) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $msg->anexo) }}" class="max-w-xs rounded-lg border border-slate-300 dark:border-slate-700 hover:opacity-90">
                                        </a>
                                    @else
                                        <a href="{{ asset('storage/' . $msg->anexo) }}" target="_blank" class="text-xs underline flex items-center gap-1 {{ $isMe ? 'text-white' : 'text-blue-500' }}">
                                            📄 Visualizar Arquivo
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                    </div>
                @empty
                    <p class="text-center text-xs text-slate-400 dark:text-slate-600 py-4">
                        Nenhuma mensagem trocada ainda. Escreva abaixo para iniciar a conversa!
                    </p>
                @endforelse