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
        Schema::create('hotel_room_configurations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('hotel_id')->comment('Foranea de la tabla hoteles');
            $table->foreign('hotel_id')->references('id')->on('hotels');

            $table->unsignedBigInteger('room_type_id')->comment('Foranea del tipo de cuarto');
            $table->foreign('room_type_id')->references('id')->on('room_types');

            $table->unsignedBigInteger('acommodation_type_id')->comment('Foranea del tipo de acomodacion');
            $table->foreign('acommodation_type_id')->references('id')->on('acommodation_types');

            $table->integer('room_number')->comment('numero de cuartos configurados por tipo y acomodacion');
            $table->integer('floor')->comment('piso de cuartos configurados por tipo y acomodacion');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_room_configurations');
    }
};
