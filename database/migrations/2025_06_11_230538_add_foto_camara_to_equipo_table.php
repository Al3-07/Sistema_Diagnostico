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
        Schema::table('equipo', function (Blueprint $table) {
             $table->string('foto_antes_camara')->nullable()->after('foto_antes');
            $table->string('foto_despues_camara')->nullable()->after('foto_despues');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('equipo', function (Blueprint $table) {
            $table->dropColumn('foto_antes_camara');
            $table->dropColumn('foto_despues_camara');
        });
    }
};
