<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'child_id',
        'activity_name',
        'rating',
        'comment',
    ];

    /**
     * Get the child that owns the review.
     */
    public function child()
    {
        return $this->belongsTo(Child::class);
    }
}
