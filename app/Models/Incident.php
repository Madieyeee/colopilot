<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'child_id',
        'user_id',
        'type',
        'incident_date',
        'description',
        'follow_up',
        'status',
    ];

    /**
     * Get the child associated with the incident.
     */
    public function child()
    {
        return $this->belongsTo(Child::class);
    }

    /**
     * Get the user who reported the incident.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
