<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Woenel\Prpcmblmts\Models\PhilippineCity;
use Woenel\Prpcmblmts\Models\PhilippineRegion;
use Woenel\Prpcmblmts\Models\PhilippineBarangay;
use Woenel\Prpcmblmts\Models\PhilippineProvince;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'contact_number',
        'address_1',
        'address_2',
        'bio'
    ];

    protected $casts = [
        'bio' => 'array',
        'address_1' => 'string',
        'address_2' => 'string',
    ];


    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
