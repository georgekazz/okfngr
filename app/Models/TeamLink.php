<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamLink extends Model
{
    protected $fillable = [
        'title',
        'description',
        'url',
        'icon',
        'category',
        'order',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}