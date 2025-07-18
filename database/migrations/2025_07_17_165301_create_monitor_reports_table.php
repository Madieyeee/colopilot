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
        Schema::create('monitor_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Lien vers le moniteur

            // Section 1: Départ de la colonie
            $table->string('q1_dispositif')->nullable();
            $table->string('q1_voyage')->nullable();

            // Section 2: Aspects pédagogiques
            $table->string('q2_organisation')->nullable();
            $table->text('q2_amelioration')->nullable();
            $table->string('q2_repartition_groupes')->nullable();
            $table->string('q2_referentiel_aivlt')->nullable();
            $table->string('q2_courbe_activites')->nullable();

            // Section 3: Relations et cohabitation
            $table->text('q3_relations')->nullable();

            // Section 4: Hébergement et la restauration
            $table->text('q4_hebergement_restauration')->nullable();

            // Section 5: Autres suggestions
            $table->text('q5_suggestions')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitor_reports');
    }
};
