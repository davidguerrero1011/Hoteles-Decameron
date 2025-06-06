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
        Schema::create('room_type_accommodations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('room_type_id')->comment('Foranea hacia tipos de cuarto');
            $table->foreign('room_type_id')->references('id')->on('room_types');
            
            $table->unsignedBigInteger('accommodation_type_id')->comment('Foranea hacia tipos de acomodaciones');
            $table->foreign('accommodation_type_id')->references('id')->on('acommodation_types');

             $table->boolean('status')->default(true)->comment('Estado de la configuracion de las acomodaciones por tipo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_type_accommodations');
    }
};
