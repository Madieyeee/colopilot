<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'activity_name',
        'description',
        'start_time',
        'end_time',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
