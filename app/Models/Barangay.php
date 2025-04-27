<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barangay extends Model
{
    protected $fillable = [
        'brgy_name',
        'brgy_slug',
        'brgy_logo',
        'brgy_img_gallery',
        'brgy_desc',
        'created_by',
        'is_published',
        'is_featured',
    ];
    protected $casts = [
        'brgy_img_gallery' => 'array',
    ];
    public function fiestas() : HasMany
    {
        return $this->hasMany(Fiesta::class);
    }

    public function barangayCaptains() : HasMany
    {
        return $this->hasMany(BarangayCaptain::class);
    }
}
