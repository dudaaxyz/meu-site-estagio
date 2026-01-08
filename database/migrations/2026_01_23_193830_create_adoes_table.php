<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('adoes', function (Blueprint $table) {
            $table->id();
            $table->string('nome_animal');
            $table->string('tipo'); // Cachorro ou Gato
            $table->string('raca');
            $table->string('idade');
            $table->string('sexo'); // Macho ou Fêmea
            $table->string('nome_usuario'); // Nome de quem quer adotar
            $table->string('email_usuario'); // E-mail de quem quer adotar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adoes');
    }
};
