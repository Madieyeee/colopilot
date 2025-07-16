<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'child_id',
        'absence_date',
        'user_id', // Qui a signalé
        'reason',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'absence_date' => 'date',
    ];

    /**
     * Get the child associated with the attendance record.
     */
    public function child()
    {
        return $this->belongsTo(Child::class);
    }

    /**
     * Get the user who reported the absence.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
