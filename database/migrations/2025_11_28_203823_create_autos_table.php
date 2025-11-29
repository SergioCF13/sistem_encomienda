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
    Schema::create('autos', function (Blueprint $table) {
        $table->id('id_auto');
        $table->string('placa', 20)->unique();
        $table->string('marca', 50);
        $table->string('modelo', 50);
        $table->decimal('capacidad', 8, 2);
        $table->enum('estado', ['Disponible', 'En ruta', 'Mantenimiento'])->default('Disponible');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autos');
    }
};
