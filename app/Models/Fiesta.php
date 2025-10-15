<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Guava\Calendar\Contracts\Eventable;
use Illuminate\Database\Eloquent\Model;
use Guava\Calendar\ValueObjects\CalendarEvent;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Fiesta extends Model implements Eventable
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
        'is_published',
    ];

    protected $casts = [
        'f_images' => 'array',
        'f_location' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'tags' => 'array',
        'f_start_date' => 'date',
        'f_end_date' => 'date',
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

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function comments() : HasMany
    {
        return $this->hasMany(Comments::class);
    }


    public function reviews() : HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function toCalendarEvent(): CalendarEvent|array {

        return CalendarEvent::make($this)
            ->title($this->f_name)
            ->start(Carbon::parse($this->f_start_date))
            ->end(Carbon::parse($this->f_end_date))
            ->allDay(true)
            ->styles([
                'background-color' => '#ff9800',
                'font-size: 10px'
            ]);
    }
}
