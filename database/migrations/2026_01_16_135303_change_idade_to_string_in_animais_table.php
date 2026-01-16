<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('animais', function (Blueprint $table) {
            $table->string('idade', 50)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('animais', function (Blueprint $table) {
            $table->integer('idade')->nullable()->change();
        });
    }
};
