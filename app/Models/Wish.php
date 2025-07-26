<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wish extends Model
{
    protected $fillable = [
        'child_id',
        'category',
        'description',
        'status',
    ];

    /**
     * Get the child that owns the wish.
     */
    public function child()
    {
        return $this->belongsTo(Child::class);
    }
}
