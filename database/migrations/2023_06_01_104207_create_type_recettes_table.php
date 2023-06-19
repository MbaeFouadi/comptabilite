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
        Schema::create('type_recettes', function (Blueprint $table) {
            $table->id();
            $table->string('designation', 255);
            $table->double('prix', 255);
            $table->integer('hologramme');
            $table->integer('employe');
            $table->integer('location');
            $table->integer('etat');
            $table->integer('annee_id');
            $table->integer('droit_inscription');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_recettes');
    }
};
