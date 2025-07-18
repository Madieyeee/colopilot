<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MonitorReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        // Section 1: Le Projet Pédagogique et les Activités
        'q1_projet_comprehension',
        'q1_activites_adequation',
        'q1_activites_equilibre',
        'q1_activites_ressources',
        'q1_activite_top',
        'q1_activite_flop',
        // Section 2: La Vie Quotidienne et le Bien-être des Enfants
        'q2_rythme_journee',
        'q2_enfants_integration',
        'q2_conflits_gestion',
        'q2_participation_enfants',
        // Section 3: La Dynamique de l'Équipe d'Animation
        'q3_equipe_accueil',
        'q3_equipe_communication',
        'q3_equipe_soutien_direction',
        'q3_equipe_ambiance',
        // Section 4: Sécurité, Hygiène et Logistique
        'q4_securite_respect',
        'q4_hygiene_locaux',
        'q4_restauration_qualite',
        'q4_logistique_transport',
        // Section 5: Bilan Personnel et Suggestions Stratégiques
        'q5_bilan_personnel',
        'q5_suggestion_cle',
        'q5_revenir',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
