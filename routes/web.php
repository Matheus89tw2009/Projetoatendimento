<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;

// 1. Tela Inicial
Route::view('/', 'empresa');

// 2. Tela de Login
Route::view('/login', 'auth.login')->name('login');

// Processar Login Comum (Cliente)
Route::post('/login', [AuthController::class, 'login']);

// Login do Técnico via Código Secreto
Route::post('/login-tecnico', [AuthController::class, 'loginTecnico'])->name('login.tecnico');

// 3. Tela de Cadastro (APENAS CLIENTE)
Route::view('/register', 'auth.register')->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

// 4. Logout
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');


// ========================================================
// 5. ÁREA PROTEGIDA (Exige conta logada e usa TicketController)
// ========================================================
Route::middleware(['auth'])->group(function () {

    // Painel Principal
    Route::get('/painel', [TicketController::class, 'index'])->name('painel');

    // Rota dupla para criação de ticket (Resolve o problema do /tickets e /criar-ticket)
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::post('/criar-ticket', [TicketController::class, 'store']);
    Route::get('/criar-ticket', [TicketController::class, 'voltarAoPainel']);

    // Assumir Chamado
    Route::post('/ticket/{id}/assumir', [TicketController::class, 'assumir'])->name('tickets.assumir');

    // Atualizar Status
    Route::post('/ticket/{id}/status', [TicketController::class, 'status'])->name('tickets.status');

    // Definir Prioridade (Técnicos/Admins)
    Route::post('/ticket/{id}/prioridade', [TicketController::class, 'prioridade'])->name('tickets.prioridade');

    // Avaliação do Cliente
    Route::post('/ticket/{id}/avaliar', [TicketController::class, 'avaliar'])->name('tickets.avaliar');

    // Histórico de Avaliações (Técnicos/Admins)
    Route::get('/avaliacoes', [TicketController::class, 'avaliacoes'])->name('tickets.avaliacoes');

    // Visualizar detalhes/chat do ticket
    Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');

    // Atualização automática do chat (consultada de tempos em tempos pela tela do chamado)
    Route::get('/tickets/{id}/atualizacoes', [TicketController::class, 'atualizacoes'])->name('tickets.atualizacoes');

    // Enviar mensagem no Chat
    Route::post('/tickets/{id}/comentar', [TicketController::class, 'comentar'])->name('tickets.mensagem');

});