<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comments extends Model
{
    protected $fillable = [
        'user_id',
        'fiesta_id',
        'comment',
        'is_approved',
    ];

    protected $casts = [
        'comment_imgs' => 'array',
        'is_approved' => 'boolean',
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
