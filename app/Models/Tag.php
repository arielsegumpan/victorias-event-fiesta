<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    protected $fillable = [
        'tag_name',
        'tag_slug',
        'tag_image',
        'tag_description',
    ];

    public function fiestas() : BelongsToMany
    {
        return $this->belongsToMany(Fiesta::class, 'fiesta_tag', 'tag_id', 'fiesta_id')->withTimestamps();
    }
}
