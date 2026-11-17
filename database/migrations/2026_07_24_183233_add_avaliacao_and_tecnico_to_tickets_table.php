<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. O 'if' fica FORA: só altera a tabela se 'avaliacao' NÃO existir no banco
        if (!Schema::hasColumn('tickets', 'avaliacao')) {
            Schema::table('tickets', function (Blueprint $table) {
                $table->integer('avaliacao')->nullable()->after('status');
            });
        }

        // 2. O 'if' fica FORA: só altera a tabela se 'tecnico_id' NÃO existir no banco
        if (!Schema::hasColumn('tickets', 'tecnico_id')) {
            Schema::table('tickets', function (Blueprint $table) {
                $table->foreignId('tecnico_id')
                      ->nullable()
                      ->after('avaliacao')
                      ->constrained('users')
                      ->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('tickets', 'tecnico_id')) {
            Schema::table('tickets', function (Blueprint $table) {
                $table->dropForeign(['tecnico_id']);
                $table->dropColumn('tecnico_id');
            });
        }

        if (Schema::hasColumn('tickets', 'avaliacao')) {
            Schema::table('tickets', function (Blueprint $table) {
                $table->dropColumn('avaliacao');
            });
        }
    }
};