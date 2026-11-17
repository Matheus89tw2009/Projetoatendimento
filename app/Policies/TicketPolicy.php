<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Centraliza as regras de "quem pode fazer o quê" nos chamados.
 * Antes essas checagens estavam repetidas em vários métodos do TicketController.
 */
class TicketPolicy
{
    use HandlesAuthorization;

    /** Técnico/Admin vê qualquer chamado; cliente só o que é dele. */
    public function view(User $user, Ticket $ticket)
    {
        return $user->ehTecnicoOuAdmin() || $this->ehDono($user, $ticket);
    }

    /** Mesma regra de visualização: quem vê o chat pode escrever nele. */
    public function comentar(User $user, Ticket $ticket)
    {
        return $this->view($user, $ticket);
    }

    /** Somente o criador do chamado pode avaliar o atendimento. */
    public function avaliar(User $user, Ticket $ticket)
    {
        return $this->ehDono($user, $ticket);
    }

    /** Assumir chamado: apenas Técnico/Admin. */
    public function assumir(User $user)
    {
        return $user->ehTecnicoOuAdmin();
    }

    /** Alterar status: apenas Técnico/Admin. */
    public function alterarStatus(User $user)
    {
        return $user->ehTecnicoOuAdmin();
    }

    /** Definir prioridade: apenas Técnico/Admin. */
    public function definirPrioridade(User $user)
    {
        return $user->ehTecnicoOuAdmin();
    }

    /** Ver o histórico de avaliações: apenas Técnico/Admin. */
    public function verAvaliacoes(User $user)
    {
        return $user->ehTecnicoOuAdmin();
    }

    /** Dono = mesmo user_id OU mesmo e-mail de abertura (igual ao comportamento antigo). */
    protected function ehDono(User $user, Ticket $ticket)
    {
        return (int) $user->id === (int) $ticket->user_id
            || $user->email === $ticket->usuario_email;
    }
}