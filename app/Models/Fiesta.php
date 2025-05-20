<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fiesta extends Model
{
    protected $fillable = [
        'barangay_id',
        'created_by',
        'category_id',
        'f_name',
        'f_slug',
        'f_images',
        'f_description',
        'f_start_date',
        'f_end_date',
        'is_featured',
        'is_approved',
    ];

    protected $casts = [
        'f_images' => 'array',
        'f_location' => 'array',
        'f_start_date' => 'datetime',
        'f_end_date' => 'datetime',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'is_approved' => 'boolean',
        'tags' => 'array',
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

    public function barangay() : BelongsTo
    {
        return $this->belongsTo(Barangay::class, 'barangay_id');
    }


    public function comments() : HasMany
    {
        return $this->hasMany(Comments::class);
    }


    public function reviews() : HasMany
    {
        return $this->hasMany(Review::class);
    }
}
