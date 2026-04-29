<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class GalleryGroup extends Model
{
    protected $fillable = ['title', 'description', 'date'];
 
    protected $casts = [
        'date' => 'date',
    ];
 
    public function photos()
    {
        return $this->hasMany(GalleryPhoto::class, 'group_id')->orderBy('order');
    }
}