<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sent extends Model
{
    /** @use HasFactory<\Database\Factories\SentFactory> */
    use HasFactory;


    protected $fillable = [
        'user_id',
        'contact_id',
        'message',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function contact() : BelongsTo
    {
        return $this->belongsTo(Contact::class, 'contact_id', 'id');
    }

}
