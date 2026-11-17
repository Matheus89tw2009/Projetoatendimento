<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'tipo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Define dinamicamente o tipo de usuário baseado no e-mail
     */
    public function getTipoAttribute($value)
    {
        // ✉️ Digite aqui o(s) e-mail(s) do(s) seu(s) técnico(s)
        $emailsTecnicos = [
            'tecnico@empresa.com',
            'admin@helpdesk.com', // Adicione outros e-mails se necessário
        ];

        if (in_array(strtolower($this->attributes['email'] ?? ''), $emailsTecnicos)) {
            return 'tecnico';
        }

        return $value ?? 'cliente';
    }

    /**
     * Verdadeiro quando o usuário é Técnico ou Admin.
     * Centraliza a checagem que antes se repetia em vários arquivos.
     */
    public function ehTecnicoOuAdmin()
    {
        return in_array(trim(strtolower($this->tipo ?? '')), ['tecnico', 'admin']);
    }

    /**
     * Relacionamento: Um usuário pode ter vários comentários.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Relacionamento: Um usuário pode ter vários tickets criados.
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}