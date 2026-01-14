<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('adoes', function (Blueprint $table) {
            $table->string('animal')->nullable();
            $table->boolean('termo_aceito')->default(false);
            $table->string('assinatura')->nullable();
            $table->timestamp('termo_aceito_em')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('adoes', function (Blueprint $table) {
            $table->dropColumn(['animal', 'termo_aceito', 'assinatura', 'termo_aceito_em']);
        });
    }
};
