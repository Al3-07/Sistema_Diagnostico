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
        $table->date('fecha')->nullable()->after('id'); 
    });
}

public function down(): void
{
    Schema::table('equipo', function (Blueprint $table) {
        $table->dropColumn('fecha');
    });
}

};
