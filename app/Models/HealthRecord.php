<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Child;

class HealthRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id',
        'allergies',
        'medical_conditions',
        'emergency_contact',
    ];

    public function child()
    {
        return $this->belongsTo(Child::class);
    }
}
