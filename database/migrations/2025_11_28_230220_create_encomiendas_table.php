<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('encomiendas', function (Blueprint $table) {
            $table->id('id_encomienda');
            $table->string('codigo_barra', 50)->unique();
            $table->string('descripcion', 150);
            $table->decimal('peso', 8, 2);
            $table->date('fecha_envio');
            $table->date('fecha_entrega')->nullable();
            $table->enum('estado', ['En tránsito','Entregado','Cancelado'])->default('En tránsito');

            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_empleado'); // users
            $table->unsignedBigInteger('id_sucursal_origen');
            $table->unsignedBigInteger('id_sucursal_destino');
            $table->unsignedBigInteger('id_chofer');
            $table->unsignedBigInteger('id_auto');

            $table->timestamps();

            $table->foreign('id_cliente')->references('id_cliente')->on('clientes');
            $table->foreign('id_empleado')->references('id')->on('users');
            $table->foreign('id_sucursal_origen')->references('id_sucursal')->on('sucursales');
            $table->foreign('id_sucursal_destino')->references('id_sucursal')->on('sucursales');
            $table->foreign('id_chofer')->references('id_chofer')->on('choferes');
            $table->foreign('id_auto')->references('id_auto')->on('autos');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('encomiendas');
    }
};
