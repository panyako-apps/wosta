<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public const PUBLISHED = 'published';
    
    protected $fillable = [
        'name',
        'description',
        'post_category_id',
        'image',
        'slug',
        'tags',
        'status',
        'published_by',
        'published_at',
        'updated_by',
        'updated_at',
        'isFeatured',
        'isPublished',
    ];


    public function postCategory(){
        return $this->belongsTo(PostCategory::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ownedBy(User $user, Post $post){
        return $user->id === $post->user_id;
    }

    public function likedBy(User $user){
        return $this->likes->contains('user_id', $user->id);
    }

    public function views()
    {
        return $this->morphMany(View::class, 'viewable');
    }

    public function likes(){
        return $this->morphMany(Like::class, 'likeable');
    } 

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }
 
    // public function viewed()
    // {
    //     if(auth()->id()==null){
    //         return $this->views()
    //         ->where('ip', '=',  request()->ip())->exists();
    //     }

    //     return $this->views()
    //     ->where(function($viewsQuery) { 
    //         $viewsQuery->where('session_id', '=', request()->getSession()->getId())
    //         ->orWhere('user_id', '=', (auth()->check()));
    //     })->exists();  
    // }



}
