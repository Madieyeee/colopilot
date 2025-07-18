<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MonitorReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'q1_dispositif',
        'q1_voyage',
        'q2_organisation',
        'q2_amelioration',
        'q2_repartition_groupes',
        'q2_referentiel_aivlt',
        'q2_courbe_activites',
        'q3_relations',
        'q4_hebergement_restauration',
        'q5_suggestions',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
