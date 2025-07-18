<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('monitor_reports', function (Blueprint $table) {
            // Drop old columns if they exist, except for the essentials
            $old_columns = [
                'q1_dispositif', 'q1_voyage', 'q2_organisation', 'q2_ameliorations',
                'q2_repartition_groupes', 'q2_referents', 'q2_rythme_activites',
                'q3_relations_moniteurs', 'q3_relations_enfants', 'q3_relations_moniteurs_enfants',
                'q4_hebergement', 'q4_restauration', 'q5_suggestions'
            ];
            foreach ($old_columns as $column) {
                if (Schema::hasColumn('monitor_reports', $column)) {
                    $table->dropColumn($column);
                }
            }

            // Section 1: Le Projet Pédagogique et les Activités
            $table->text('q1_projet_comprehension')->nullable();
            $table->text('q1_activites_adequation')->nullable();
            $table->text('q1_activites_equilibre')->nullable();
            $table->text('q1_activites_ressources')->nullable();
            $table->text('q1_activite_top')->nullable();
            $table->text('q1_activite_flop')->nullable();

            // Section 2: La Vie Quotidienne et le Bien-être des Enfants
            $table->text('q2_rythme_journee')->nullable();
            $table->text('q2_enfants_integration')->nullable();
            $table->text('q2_conflits_gestion')->nullable();
            $table->text('q2_participation_enfants')->nullable();

            // Section 3: La Dynamique de l'Équipe d'Animation
            $table->text('q3_equipe_accueil')->nullable();
            $table->text('q3_equipe_communication')->nullable();
            $table->text('q3_equipe_soutien_direction')->nullable();
            $table->text('q3_equipe_ambiance')->nullable();

            // Section 4: Sécurité, Hygiène et Logistique
            $table->text('q4_securite_respect')->nullable();
            $table->text('q4_hygiene_locaux')->nullable();
            $table->text('q4_restauration_qualite')->nullable();
            $table->text('q4_logistique_transport')->nullable();

            // Section 5: Bilan Personnel et Suggestions Stratégiques
            $table->text('q5_bilan_personnel')->nullable();
            $table->text('q5_suggestion_cle')->nullable();
            $table->text('q5_revenir')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('monitor_reports', function (Blueprint $table) {
            $new_columns = [
                'q1_projet_comprehension', 'q1_activites_adequation', 'q1_activites_equilibre',
                'q1_activites_ressources', 'q1_activite_top', 'q1_activite_flop',
                'q2_rythme_journee', 'q2_enfants_integration', 'q2_conflits_gestion',
                'q2_participation_enfants', 'q3_equipe_accueil', 'q3_equipe_communication',
                'q3_equipe_soutien_direction', 'q3_equipe_ambiance', 'q4_securite_respect',
                'q4_hygiene_locaux', 'q4_restauration_qualite', 'q4_logistique_transport',
                'q5_bilan_personnel', 'q5_suggestion_cle', 'q5_revenir'
            ];
            foreach ($new_columns as $column) {
                 if (Schema::hasColumn('monitor_reports', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
