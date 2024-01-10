<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'slideshow_id',
        'image',
        'description',
        'isPublished',
        'published_by',
        'published_at',
        'updated_by',
        'updated_at',
    ];

    public function slideshow(){
        return $this->belongsTo(Slideshow::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}

