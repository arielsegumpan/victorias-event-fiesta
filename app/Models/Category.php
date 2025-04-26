<?php

namespace App\Models;

use App\Models\Fiesta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'cat_name',
        'cat_slug',
        'cat_image',
        'cat_description',
    ];

    public function fiestas() : HasMany
    {
        return $this->hasMany(Fiesta::class);
    }

}
