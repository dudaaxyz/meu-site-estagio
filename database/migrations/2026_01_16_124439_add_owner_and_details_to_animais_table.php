<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('animais', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('descricao')->nullable();
            $table->string('cidade')->nullable();
            $table->string('uf', 2)->nullable();
            $table->string('contato_whatsapp')->nullable();

            $table->foreign('user_id')
                ->references('id')
                ->on('usuarios')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('animais', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'descricao', 'cidade', 'uf', 'contato_whatsapp']);
        });
    }
};
