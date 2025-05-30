<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BarangayCaptain extends Model
{
    protected $fillable = [
        'barangay_id',
        'user_id',
        'term_start',
        'term_end',
    ];
    protected $casts = [
        'term_start' => 'date',
        'term_end' => 'date',
    ];

    public function barangay() : BelongsTo
    {
        return $this->belongsTo(Barangay::class, 'barangay_id');
    }
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
