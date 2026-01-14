<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('animais', function (Blueprint $table) {
            $table->string('raca')->nullable()->after('especie');
            $table->string('sexo')->nullable()->after('raca');
        });
    }

    public function down(): void
    {
        Schema::table('animais', function (Blueprint $table) {
            $table->dropColumn(['raca', 'sexo']);
        });
    }
};
