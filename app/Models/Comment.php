<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // Permite que esses campos sejam gravados no banco
    protected $fillable = [
        'ticket_id', 
        'user_id', 
        'mensagem',
        'anexo', // <-- Suporte para anexos/imagens no chat
    ];

    // Relacionamento com o Usuário que comentou
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relacionamento com o Ticket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
}