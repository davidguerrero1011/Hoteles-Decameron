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
        Schema::create('hotels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('Nombre del hotel');
            $table->unsignedInteger('rooms')->comment('Numero de cuartos por hotel');
            $table->string('address')->nullable()->comment('Direccion del hotel');
            $table->string('nit', 10)->nullable()->comment('Nit o numero de identificacion tributaria del hotel');

            $table->unsignedBigInteger('city_id')->comment('Foranea de la tabla de ciudades');
            $table->foreign('city_id')->references('id')->on('cities');

            $table->boolean('status')->default(true)->comment('Estado del hotel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
