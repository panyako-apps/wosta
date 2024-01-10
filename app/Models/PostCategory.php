<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'icon',
        'slug',
        'image',
        'description',
        'isFeatured',
        'isPublished',
        'published_by',
        'published_at',
        'updated_by',
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }
    
    public function childrenCategories(){
        return $this->hasMany(PostCategory::class, 'parent_id');
    }

    public function parentCategory(){
        return $this->belongsTo(PostCategory::class, 'parent_id');
    }

}
