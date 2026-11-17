<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * E-mail simples avisando sobre um chamado (assumido, resolvido, cliente respondeu).
 * É enviado na hora (sem fila), então não exige "queue:work".
 */
class TicketNotificacao extends Notification
{
    use Queueable;

    protected $ticket;
    protected $titulo;
    protected $mensagem;

    public function __construct(Ticket $ticket, $titulo, $mensagem)
    {
        $this->ticket = $ticket;
        $this->titulo = $titulo;
        $this->mensagem = $mensagem;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            // Se MAIL_FROM_ADDRESS estiver vazio/"null" no .env, usa um remetente padrão
            ->from(config('mail.from.address') ?: 'suporte@helpdesk.local', config('mail.from.name') ?: 'Helpdesk')
            ->subject('[Chamado #' . $this->ticket->id . '] ' . $this->titulo)
            ->greeting('Olá, ' . $notifiable->name . '!')
            ->line($this->mensagem)
            ->line('Assunto do chamado: ' . $this->ticket->assunto)
            ->action('Abrir chamado', url('/tickets/' . $this->ticket->id))
            ->salutation('Equipe Helpdesk');
    }
}