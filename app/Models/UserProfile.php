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
        'region_id',
        'province_id',
        'city_id',
        'barangay_id',
        'street',
        'full_address',
    ];

    protected $casts = [
        'region_id' => 'integer',
        'province_id' => 'integer',
        'city_id' => 'integer',
        'barangay_id' => 'integer',
    ];


    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function region() : BelongsTo
    {
        return $this->belongsTo(PhilippineRegion::class, 'region_id');
    }

    public function province() : BelongsTo
    {
        return $this->belongsTo(PhilippineProvince::class, 'province_id');
    }

    public function city() : BelongsTo
    {
        return $this->belongsTo(PhilippineCity::class, 'city_id');
    }
    public function barangay() : BelongsTo
    {
        return $this->belongsTo(PhilippineBarangay::class, 'barangay_id');
    }
    public function getFullAddressAttribute() : string
    {
        return trim("{$this->street}, {$this->barangay->name}, {$this->city->name}, {$this->province->name}, {$this->region->name}");
    }
}
