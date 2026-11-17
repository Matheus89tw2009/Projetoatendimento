<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('assunto');
            $table->string('categoria');
            $table->string('subcategoria')->nullable(); // <-- Coluna adicionada
            $table->text('descricao');                  // <-- Coluna descricao bem definida
            $table->string('status')->default('Aberto');
            $table->string('usuario_email');
            $table->text('resposta')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};