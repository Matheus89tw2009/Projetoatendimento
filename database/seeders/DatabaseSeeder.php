<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Cria ou atualiza a conta do técnico no banco de dados
        User::updateOrCreate(
            ['email' => 'tecnico@empresa.com'],
            [
                'name'     => 'Técnico de Suporte',
                'password' => Hash::make('12345678'), // 🔑 Sua senha definida
                'tipo'     => 'tecnico',
            ]
        );
    }
}