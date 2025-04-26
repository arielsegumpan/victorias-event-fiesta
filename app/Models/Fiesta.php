<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Fiesta extends Model
{
    protected $fillable = [
        'category_id',
        'f_name',
        'f_slug',
        'f_image',
        'f_description',
        'f_start_date',
        'f_end_date',
        'f_location',
        'is_active',
        'is_featured',
        'is_approved',
    ];

    protected $casts = [
        'f_image' => 'array',
        'f_location' => 'array',
        'f_start_date' => 'datetime',
        'f_end_date' => 'datetime',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'is_approved' => 'boolean',
    ];

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'fiesta_tag', 'fiesta_id', 'tag_id')->withTimestamps();
    }
}
