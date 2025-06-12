<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBitacorasTable extends Migration
{
    public function up(): void
{
    Schema::create('bitacoras', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id')->nullable();
        $table->string('accion');
        $table->text('descripcion')->nullable();
        $table->string('ip', 45)->nullable();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('bitacoras');
    }
}
