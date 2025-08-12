<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'slug',
        'is_published',
        'published_at',
        'image',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    // Additional methods can be added here as needed
   
}
