<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Login, cadastro e logout.
 * Estas ações ficavam como funções soltas no routes/web.php (o que impede o
 * "php artisan route:cache"). A lógica é exatamente a mesma de antes.
 */
class AuthController extends Controller
{
    /** Código secreto para entrar como técnico (mesmo valor de antes). */
    const CODIGO_TECNICO = '1234';

    /** Processar Login Comum (Cliente) */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/painel');
        }

        return back()->with('erro', 'E-mail ou senha inválidos!');
    }

    /** Login do Técnico via Código Secreto */
    public function loginTecnico(Request $request)
    {
        if ($request->input('codigo_secreto') !== self::CODIGO_TECNICO) {
            return back()->with('erro', 'Código secreto do técnico incorreto!');
        }

        $tecnico = User::firstOrCreate(
            ['email' => 'tecnico@suporte.com'],
            [
                'name' => 'Técnico de Suporte',
                'password' => Hash::make('tecnico123'),
                'tipo' => 'tecnico'
            ]
        );

        if ($tecnico->tipo !== 'tecnico') {
            $tecnico->tipo = 'tecnico';
            $tecnico->save();
        }

        Auth::login($tecnico);

        return redirect('/painel');
    }

    /** Cadastro (APENAS CLIENTE) */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipo' => 'cliente',
        ]);

        Auth::login($user);

        return redirect('/painel');
    }

    /** Logout */
    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}