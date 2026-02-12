<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'event_date',
        'location',
        'links',
        'image',
        'status',
        'user_id',
    ];

    protected $casts = [
        'links' => 'array',
        'event_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope for published events
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Scope for ordering by event date
    public function scopeOrderByEventDate($query, $direction = 'desc')
    {
        return $query->orderBy('event_date', $direction);
    }
}