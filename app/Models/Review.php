<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'fiesta_id',
        'rating',
        'review',
        'review_images',
    ];

    protected $casts = [
        'review_images' => 'array',
        'rating' => 'integer',
    ];

    public function fiesta() : BelongsTo
    {
        return $this->belongsTo(Fiesta::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
