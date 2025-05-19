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
        Schema::create('equipo', function (Blueprint $table) {
            $table->id();
             $table->string('equipo'); 
            $table->string('modelo');
            $table->string('marca');
            $table->string('serie');
            $table->string('descripcion');
            // imágenes antes / después string  guardas la ruta ej. /public/img/123_antes.jpg.
        $table->string('foto_antes')->nullable();
        $table->string('foto_despues')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipo');
    }
};
