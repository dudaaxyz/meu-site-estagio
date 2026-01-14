<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('adoes', function (Blueprint $table) {

            // Campos do formulário
            if (!Schema::hasColumn('adoes', 'nome')) {
                $table->string('nome')->nullable();
            }

            if (!Schema::hasColumn('adoes', 'email')) {
                $table->string('email')->nullable();
            }

            if (!Schema::hasColumn('adoes', 'telefone')) {
                $table->string('telefone')->nullable();
            }

            if (!Schema::hasColumn('adoes', 'animal')) {
                $table->string('animal')->nullable();
            }

            // Termo
            if (!Schema::hasColumn('adoes', 'termo_aceito')) {
                $table->boolean('termo_aceito')->default(false);
            }

            if (!Schema::hasColumn('adoes', 'assinatura')) {
                $table->string('assinatura')->nullable();
            }

            if (!Schema::hasColumn('adoes', 'termo_aceito_em')) {
                $table->timestamp('termo_aceito_em')->nullable();
            }

            // Timestamps padrão do Laravel (pra evitar erro)
            if (!Schema::hasColumn('adoes', 'created_at')) {
                $table->timestamp('created_at')->nullable();
            }

            if (!Schema::hasColumn('adoes', 'updated_at')) {
                $table->timestamp('updated_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('adoes', function (Blueprint $table) {
            // Não removendo para não quebrar dados existentes
        });
    }
};
