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
        Schema::create('acommodation_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255)->comment('Nombre del tipo de acomodacion');
            $table->boolean('status')->default(true)->comment('Nombre del tipo de acomodacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acommodations_types');
    }
};
