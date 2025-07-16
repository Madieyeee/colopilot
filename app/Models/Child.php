<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'age',
        'group_id',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function healthRecord()
    {
        return $this->hasOne(HealthRecord::class);
    }

    public function incidents()
    {
        return $this->hasMany(Incident::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
