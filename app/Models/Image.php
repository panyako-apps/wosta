<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
       /**Mass assignable attributes */
       protected $fillable = [
        'title',
        'url',
        'description',
        'imageable_id',
        'imageable_type',
        'isFeatured',
        'isPublished',
        'published_by',
        'published_at',
        'updated_by',
    ];

    // public function imageable()
    // {
    //     return $this->morphTo();
    // }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function product(){
        return $this->belongsTo(Product::class, 'imageable_id');
    }

    public function likes(){
        return $this->morphMany(Like::class, 'likeable');
    } 

}
