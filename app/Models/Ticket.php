<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'assunto',
        'categoria',
        'subcategoria',   // <-- Adicionado aqui!
        'descricao',
        'anexo',          // <-- Suporte para anexos/imagens
        'usuario_email',
        'user_id',
        'tecnico_id',     // <-- Atribuição de técnico
        'status',
        'resposta',
        'avaliacao',      // <-- Nota do atendimento (1 a 5 estrelas)
        'prioridade',     // <-- Baixa / Normal / Alta / Urgente (define o prazo de SLA)
    ];

    /** Prioridades aceitas, da menos para a mais urgente. */
    const PRIORIDADES = ['Baixa', 'Normal', 'Alta', 'Urgente'];

    /** Prazo de atendimento (SLA) em horas para cada prioridade. Ajuste aqui se precisar. */
    const SLA_HORAS = ['Urgente' => 4, 'Alta' => 8, 'Normal' => 24, 'Baixa' => 72];

    /**
     * Relacionamento: Um ticket possui vários comentários/mensagens no chat.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'ticket_id')->orderBy('created_at', 'asc');
    }

    /**
     * Relacionamento: Pertence a um Usuário (Cliente).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relacionamento: Pertence a um Técnico responsável.
     */
    public function tecnico()
    {
        return $this->belongsTo(User::class, 'tecnico_id');
    }

    /**
     * Prioridade do chamado. Se a coluna ainda não existir (migration pendente)
     * ou estiver vazia, assume 'Normal' para nada quebrar.
     */
    public function getPrioridadeAttribute($value)
    {
        return in_array($value, self::PRIORIDADES) ? $value : 'Normal';
    }

    /** Prazo de SLA, em horas, conforme a prioridade. */
    public function slaHoras()
    {
        return self::SLA_HORAS[$this->prioridade];
    }

    /** Momento limite para resolver o chamado (abertura + SLA). */
    public function prazoSla()
    {
        return $this->created_at ? $this->created_at->copy()->addHours($this->slaHoras()) : null;
    }

    /** Verdadeiro se o prazo passou e o chamado ainda não foi resolvido. */
    public function emAtraso()
    {
        $prazo = $this->prazoSla();

        return $this->status !== 'Resolvido' && $prazo && now()->greaterThan($prazo);
    }

    /** Texto curto: "Atrasado há 3h 20min" ou "Vence em 5h". Vazio se já resolvido. */
    public function textoSla()
    {
        $prazo = $this->prazoSla();

        if ($this->status === 'Resolvido' || !$prazo) {
            return '';
        }

        $minutos = abs(now()->diffInMinutes($prazo, false));
        $texto = $minutos >= 1440
            ? floor($minutos / 1440) . 'd ' . floor(($minutos % 1440) / 60) . 'h'
            : ($minutos >= 60 ? floor($minutos / 60) . 'h ' . ($minutos % 60) . 'min' : $minutos . 'min');

        return ($this->emAtraso() ? 'Atrasado há ' : 'Vence em ') . $texto;
    }

    /**
     * Assinatura do que aparece no topo do chamado (status, técnico, nota, prioridade).
     * O chat usa isso para saber quando precisa recarregar a tela.
     */
    public function assinaturaEstado()
    {
        return implode('|', [$this->status, $this->tecnico_id, $this->avaliacao, $this->prioridade]);
    }

    /** Assinatura das mensagens do chat (quantidade + id da última), usada na atualização automática. */
    public function assinaturaMensagens()
    {
        $ultima = $this->comments->last();

        return $this->comments->count() . ':' . ($ultima ? $ultima->id : 0);
    }
}