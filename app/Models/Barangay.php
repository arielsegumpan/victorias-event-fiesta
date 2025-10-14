<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        return $this->hasMany(Fiesta::class, 'barangay_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function barangayCaptains() : HasMany
    {
        return $this->hasMany(BarangayCaptain::class, 'barangay_id');
    }

    public function currentCaptain(): HasOne
    {
        return $this->hasOne(BarangayCaptain::class, 'barangay_id')
                    ->where(function ($query) {
                        $query->whereNull('term_end')
                              ->orWhere('term_end', '>=', now());
                    })
                    ->orderBy('term_start', 'desc');
    }
}
