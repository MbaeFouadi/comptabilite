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
        Schema::create('recettes', function (Blueprint $table) {
            $table->id();
            $table->integer('matricule')->nullable();
            $table->integer('montant')->nullable();
            $table->date('date_enregistrement');
            $table->integer('type_recette_id');
            $table->integer('composante_id');
            $table->integer('employee_id');
            $table->integer('recette_location_id');
            $table->integer('annee_civil_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recettes');
    }
};
