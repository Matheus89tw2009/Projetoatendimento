<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Comment;
use App\Models\User;
use App\Notifications\TicketNotificacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    /** Quantidade de chamados por página na listagem. */
    const POR_PAGINA = 10;

    /**
     * Exibe a listagem dos chamados.
     * - Aba "chamados": apenas os ainda não avaliados (ativos)
     * - Aba "historico" (somente cliente): os já avaliados
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $ehStaff = $user->ehTecnicoOuAdmin();

        // Aba ativa: cliente começa em 'novo'; técnico/admin só usa 'chamados'
        $abasValidas = $ehStaff ? ['chamados'] : ['novo', 'chamados', 'historico'];
        $abaAtiva = $request->query('aba', $ehStaff ? 'chamados' : 'novo');
        if (!in_array($abaAtiva, $abasValidas)) {
            $abaAtiva = $ehStaff ? 'chamados' : 'novo';
        }

        $query = Ticket::query();

        // 1. Chamados avaliados ficam fora da lista ativa e aparecem no Histórico
        if ($abaAtiva === 'historico') {
            $query->whereNotNull('avaliacao');
        } else {
            $query->whereNull('avaliacao');
        }

        // 2. Se for Cliente, vê APENAS os seus próprios chamados
        if (!$ehStaff) {
            $query->where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhere('usuario_email', $user->email);
            });
        }

        // 3. Filtros de busca (ID ou Assunto)
        if ($request->filled('busca')) {
            $busca = $request->busca;
            $query->where(function ($q) use ($busca) {
                $q->where('id', 'like', "%{$busca}%")
                  ->orWhere('assunto', 'like', "%{$busca}%");
            });
        }

        // 4. Filtro por Status
        if ($request->filled('status') && $request->status !== 'todos') {
            $query->where('status', $request->status);
        }

        // 5. Filtro por Categoria (Suporte Técnico, RH, Financeiro)
        if ($request->filled('categoria') && $request->categoria !== 'todas') {
            $query->where('categoria', $request->categoria);
        }

        // 6. Paginação (mantém aba, busca e filtros nos links de página)
        $tickets = $query->orderBy('id', 'desc')
            ->paginate(self::POR_PAGINA)
            ->withQueryString();

        return view('suporte', compact('tickets', 'user', 'abaAtiva'));
    }

    /**
     * Atalho: quem abrir /criar-ticket pelo navegador volta para o painel.
     */
    public function voltarAoPainel()
    {
        return redirect('/painel');
    }

    /**
     * Processa a criação de um novo ticket (com subcategoria, anexo e validação anti-spam)
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Impede que perfis de técnico/admin criem chamados
        if ($user->ehTecnicoOuAdmin()) {
            return back()->with('erro', 'Técnicos e Administradores não podem abrir chamados.');
        }

        // Trava Anti-SPAM: Impede criar novo chamado se houver um em aberto
        $ticketAberto = Ticket::where(function ($query) use ($user) {
                $query->where('usuario_email', $user->email)
                      ->orWhere('user_id', $user->id);
            })
            ->where('status', '!=', 'Resolvido')
            ->whereNull('avaliacao')
            ->exists();

        if ($ticketAberto) {
            return back()->with('erro', 'Você já possui um chamado em andamento. Aguarde a resolução do chamado atual para abrir outro!');
        }

        // Validação dos dados do formulário
        $request->validate([
            'assunto'      => 'required|string|max:255',
            'categoria'    => 'required|string',
            'subcategoria' => 'nullable|string', // <-- Adicionado para validar a subcategoria
            'descricao'    => 'required|string',
            'anexo'        => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $caminhoAnexo = null;
        if ($request->hasFile('anexo')) {
            $caminhoAnexo = $request->file('anexo')->store('anexos', 'public');
        }

        // Salva o ticket com a subcategoria no banco de dados
        $ticket = Ticket::create([
            'assunto'       => $request->assunto,
            'categoria'     => $request->categoria,
            'subcategoria'  => $request->subcategoria, // <-- Adicionado aqui!
            'descricao'     => $request->descricao,
            'anexo'         => $caminhoAnexo,
            'usuario_email' => $user->email,
            'user_id'       => $user->id,
            'status'        => 'Aberto',
        ]);

        return redirect('/tickets/' . $ticket->id)->with('sucesso', 'Chamado aberto com sucesso!');
    }

    /**
     * Exibe a tela do Chat / Histórico de um ticket específico
     */
    public function show($id)
    {
        $ticket = Ticket::with('comments.user')->findOrFail($id);
        $user = Auth::user();

        // Verificação de permissão (regras centralizadas na TicketPolicy)
        if (!$user->can('view', $ticket)) {
            abort(403, 'Você não tem permissão para visualizar este ticket.');
        }

        return view('tickets.show', compact('ticket', 'user'));
    }

    /**
     * Devolve o HTML das mensagens + o "estado" do chamado.
     * A tela do chat consulta isso a cada poucos segundos para se atualizar sozinha.
     */
    public function atualizacoes($id)
    {
        $ticket = Ticket::with('comments.user')->findOrFail($id);

        if (!Auth::user()->can('view', $ticket)) {
            abort(403, 'Você não tem permissão para visualizar este ticket.');
        }

        return response()->json([
            'estado'    => $ticket->assinaturaEstado(),
            'mensagens' => $ticket->assinaturaMensagens(),
            'html'      => view('tickets._mensagens', compact('ticket'))->render(),
        ]);
    }

    /**
     * Atribui o técnico logado ao chamado
     */
    public function assumir($id)
    {
        $user = Auth::user();

        if (!$user->can('assumir', Ticket::class)) {
            return back()->with('erro', 'Apenas técnicos podem assumir chamados.');
        }

        $ticket = Ticket::findOrFail($id);
        $ticket->tecnico_id = $user->id;
        $ticket->status = 'Em Andamento';
        $ticket->save();

        Comment::create([
            'ticket_id' => $ticket->id,
            'user_id'   => $user->id,
            'mensagem'  => "👨‍💻 O técnico {$user->name} assumiu este atendimento.",
        ]);

        $this->notificar(
            $this->clienteDo($ticket),
            $ticket,
            'Seu chamado foi assumido',
            "O técnico {$user->name} assumiu o seu chamado e já está trabalhando nele."
        );

        return back()->with('sucesso', 'Você assumiu o atendimento deste chamado!');
    }

    /**
     * Atualiza o status do ticket
     */
    public function status(Request $request, $id)
    {
        $user = Auth::user();

        if (!$user->can('alterarStatus', Ticket::class)) {
            return back()->with('erro', 'Apenas técnicos podem alterar o status do chamado.');
        }

        $ticket = Ticket::findOrFail($id);
        $statusAntigo = $ticket->status;
        $novoStatus = $request->input('status');

        $ticket->status = $novoStatus;

        if ($request->filled('resposta')) {
            $ticket->resposta = $request->input('resposta');
        }

        $ticket->save();

        if ($statusAntigo !== $novoStatus) {
            $textoNotificacao = "📌 O status do chamado foi alterado de \"{$statusAntigo}\" para \"{$novoStatus}\".";

            if ($novoStatus === 'Resolvido' && $request->filled('resposta')) {
                $textoNotificacao .= "\n\n✅ Solução enviada pelo suporte:\n" . $request->input('resposta');
            }

            Comment::create([
                'ticket_id' => $ticket->id,
                'user_id'   => $user->id,
                'mensagem'  => $textoNotificacao,
            ]);

            // E-mail para o cliente quando o chamado é resolvido
            if ($novoStatus === 'Resolvido') {
                $aviso = 'Seu chamado foi marcado como resolvido.';
                if ($request->filled('resposta')) {
                    $aviso .= ' Solução: ' . $request->input('resposta');
                }
                $aviso .= ' Abra o chamado para avaliar o atendimento.';

                $this->notificar($this->clienteDo($ticket), $ticket, 'Seu chamado foi resolvido', $aviso);
            }
        }

        return back()->with('sucesso', "Status do chamado alterado para '{$novoStatus}' com sucesso!");
    }

    /**
     * Define a prioridade do chamado (define também o prazo de SLA)
     */
    public function prioridade(Request $request, $id)
    {
        $user = Auth::user();

        if (!$user->can('definirPrioridade', Ticket::class)) {
            return back()->with('erro', 'Apenas técnicos podem alterar a prioridade do chamado.');
        }

        // Proteção: se a migration ainda não foi executada, avisa em vez de dar erro de banco
        if (!Schema::hasColumn('tickets', 'prioridade')) {
            return back()->with('erro', 'Para usar prioridades, execute "php artisan migrate" no projeto.');
        }

        $request->validate([
            'prioridade' => 'required|in:' . implode(',', Ticket::PRIORIDADES),
        ]);

        $ticket = Ticket::findOrFail($id);
        $nova = $request->input('prioridade');

        if ($ticket->prioridade !== $nova) {
            $ticket->prioridade = $nova;
            $ticket->save();
        }

        return back()->with('sucesso', "Prioridade do chamado definida como '{$nova}'.");
    }

    /**
     * Adiciona uma mensagem/comentário no chat do ticket
     */
    public function comentar(Request $request, $id)
    {
        $request->validate([
            'mensagem' => 'nullable|string',
            'anexo' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        if (!$request->filled('mensagem') && !$request->hasFile('anexo')) {
            return back()->with('erro', 'Envie uma mensagem ou um arquivo.');
        }

        $ticket = Ticket::findOrFail($id);
        $user = Auth::user();

        if (!$user->can('comentar', $ticket)) {
            abort(403, 'Ação não autorizada.');
        }

        $caminhoAnexo = null;
        if ($request->hasFile('anexo')) {
            $caminhoAnexo = $request->file('anexo')->store('anexos', 'public');
        }

        Comment::create([
            'ticket_id' => $ticket->id,
            'user_id'   => $user->id,
            'mensagem'  => $request->mensagem ?? 'Arquivo anexado.',
            'anexo'     => $caminhoAnexo
        ]);

        // Quando o CLIENTE responde, avisa por e-mail o técnico responsável (se já houver um)
        if (!$user->ehTecnicoOuAdmin() && $ticket->tecnico_id) {
            $this->notificar(
                $ticket->tecnico,
                $ticket,
                'O cliente respondeu',
                "O cliente {$user->name} enviou uma nova mensagem: " . Str::limit($request->mensagem ?? 'Arquivo anexado.', 200)
            );
        }

        return back()->with('sucesso', 'Mensagem enviada com sucesso!');
    }

    /**
     * Processa a avaliação enviada pelo Cliente
     */
    public function avaliar(Request $request, $id)
    {
        $request->validate([
            'avaliacao' => 'required|integer|min:1|max:5',
        ]);

        $ticket = Ticket::findOrFail($id);
        $user = Auth::user();

        // Garante que só o dono do chamado pode avaliar
        if (!$user->can('avaliar', $ticket)) {
            return back()->with('erro', 'Apenas o criador do chamado pode avaliá-lo.');
        }

        // Salva a nota
        $ticket->avaliacao = $request->avaliacao;
        $ticket->save();

        // Gera notificação/comentário no histórico para o técnico visualizar
        Comment::create([
            'ticket_id' => $ticket->id,
            'user_id'   => $user->id,
            'mensagem'  => "⭐ O cliente avaliou o atendimento com nota {$request->avaliacao}/5.",
        ]);

        return redirect('/painel')->with('sucesso', 'Obrigado por avaliar nosso atendimento! O chamado foi finalizado.');
    }

    /**
     * Exibe a Nova Aba: Histórico de Avaliações (Somente Técnicos/Admins)
     */
    public function avaliacoes()
    {
        $user = Auth::user();

        // Apenas técnicos/admins podem acessar
        if (!$user->can('verAvaliacoes', Ticket::class)) {
            return redirect('/painel')->with('erro', 'Acesso não permitido.');
        }

        // Busca apenas chamados que possuem avaliação
        $ticketsAvaliados = Ticket::whereNotNull('avaliacao')->orderBy('updated_at', 'desc')->get();

        return view('avaliacoes', compact('ticketsAvaliados', 'user'));
    }

    /**
     * Cliente dono do chamado (pelo user_id ou, se faltar, pelo e-mail de abertura).
     */
    private function clienteDo(Ticket $ticket)
    {
        return $ticket->user ?: User::where('email', $ticket->usuario_email)->first();
    }

    /**
     * Envia o e-mail sem nunca derrubar a ação principal: se o e-mail falhar
     * (SMTP não configurado, por exemplo), o erro vai para storage/logs/laravel.log
     * e o sistema segue normalmente.
     */
    private function notificar($destinatario, Ticket $ticket, $titulo, $mensagem)
    {
        if (!$destinatario || empty($destinatario->email)) {
            return;
        }

        try {
            $destinatario->notify(new TicketNotificacao($ticket, $titulo, $mensagem));
        } catch (\Throwable $e) {
            report($e);
        }
    }
}