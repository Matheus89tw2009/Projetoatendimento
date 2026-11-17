<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Só cria a coluna se ela ainda não existir (seguro rodar mais de uma vez)
        if (!Schema::hasColumn('tickets', 'prioridade')) {
            Schema::table('tickets', function (Blueprint $table) {
                $table->string('prioridade')->default('Normal')->after('status');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('tickets', 'prioridade')) {
            Schema::table('tickets', function (Blueprint $table) {
                $table->dropColumn('prioridade');
            });
        }
    }
};