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
        $table->unsignedBigInteger('empresa_id')->nullable()->after('id');
        $table->foreign('empresa_id')->references('id')->on('empresa')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('equipo', function (Blueprint $table) {
        $table->dropForeign(['empresa_id']);
        $table->dropColumn('empresa_id');
    });
}

};
