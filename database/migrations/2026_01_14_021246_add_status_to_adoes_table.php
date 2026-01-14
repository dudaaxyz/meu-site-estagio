<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('adoes', function (Blueprint $table) {
            if (!Schema::hasColumn('adoes', 'status')) {
                $table->string('status')->default('pendente'); // pendente | aprovado | rejeitado
            }
            if (!Schema::hasColumn('adoes', 'decisao_em')) {
                $table->timestamp('decisao_em')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('adoes', function (Blueprint $table) {
            if (Schema::hasColumn('adoes', 'status')) $table->dropColumn('status');
            if (Schema::hasColumn('adoes', 'decisao_em')) $table->dropColumn('decisao_em');
        });
    }
};
