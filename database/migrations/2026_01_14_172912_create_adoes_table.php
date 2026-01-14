<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('adoes', function (Blueprint $table) {
            $table->id();

            // Usuário que pediu a adoção
            $table->unsignedBigInteger('user_id');

            // Animal que está sendo adotado
            $table->unsignedBigInteger('animal_id');

            // pendente | aprovado | rejeitado
            $table->string('status')->default('pendente');

            // Data da solicitação
            $table->date('data_adocao');

            // Quando o admin decidiu (aprovar/rejeitar)
            $table->timestamp('decisao_em')->nullable();

            $table->timestamps();

            // Chaves estrangeiras
            $table->foreign('user_id')
                  ->references('id')
                  ->on('usuarios')
                  ->onDelete('cascade');

            $table->foreign('animal_id')
                  ->references('id')
                  ->on('animais')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('adoes');
    }
};
