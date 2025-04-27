<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FiestaTag extends Model
{
    use HasFactory;

    protected $table = 'fiesta_tag';

    protected $fillable = ['fiesta_id', 'tag_id'];
}
