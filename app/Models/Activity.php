<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'morning_activity',
        'afternoon_activity',
        'evening_activity',
        'responsible',
    ];
}
