<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('equipo', function (Blueprint $table) {
        $table->string('firma_realizado')->nullable()->after('foto_despues');
        $table->string('firma_supervisado')->nullable()->after('firma_realizado');
        $table->string('firma_recibido')->nullable()->after('firma_supervisado');
    });
}

public function down()
{
    Schema::table('equipo', function (Blueprint $table) {
        $table->dropColumn(['firma_realizado', 'firma_supervisado', 'firma_recibido']);
    });
}

};
