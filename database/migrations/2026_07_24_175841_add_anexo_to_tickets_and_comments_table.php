<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {$table->string('anexo')->nullable()->after('descricao');
        });

        Schema::table('comments', function (Blueprint $table) {$table->string('anexo')->nullable()->after('mensagem');
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {$table->dropColumn('anexo');
        });

        Schema::table('comments', function (Blueprint $table) {$table->dropColumn('anexo');
        });
    }
};