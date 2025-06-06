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
        Schema::create('cities', function (Blueprint $table) {
           $table->bigIncrements('id');
            $table->string('name', 255)->comment('El nombre de la ciudad');

            $table->unsignedBigInteger('country_id')->comment('Llave foranea hacia la tabla de paises');
            $table->foreign('country_id')->references('id')->on('countries');

            $table->boolean('status')->default(true)->comment('Indica el estado de la ciudad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
