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
        Schema::create('depenses', function (Blueprint $table) {
            $table->id();
            $table->float('montant');
            $table->text('description')->nullable();
            $table->integer('numero_cheque')->nullable();
            $table->string('beneficiaire', 255)->nullable();
            $table->string('facture', 255)->nullable();
            $table->integer('composante_id')->nullable();
            $table->integer('annee_civil_id');
            $table->integer('plan_comptable_id');
            $table->integer('type_depense_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depenses');
    }
};
