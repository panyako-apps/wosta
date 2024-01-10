<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slideshow extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'slug',
        'position',
        'description',
        'isPublished',
        'published_by',
        'published_at',
        'updated_by',
        'updated_at',
    ];


    public function slides(){
        return $this->hasMany(Slide::class, 'slideshow_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
