<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_category_id',
        'name',
        'slug',
        'description',
        'image',
        'tags',
        'isFeatured',
        'isPublished',
        'published_by',
        'published_at',
        'updated_by',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function likes(){
        return $this->morphMany(Like::class, 'likeable');
    } 

    public function views()
    {
        return $this->morphMany(View::class, 'viewable');
    }

    public function ownedBy(User $user, Product $product){
        return $user->id === $product->user_id;
    }

    public function viewed($product)
    {
        if(auth()->id()!==null && !$this->ownedBy(auth()->user(), $product))
        {
            return $this->views()
                ->where(function($viewsQuery) { 
                    $viewsQuery->where('session_id', '=', request()->getSession()->getId())
                    ->orWhere('user_id', '=', (auth()->user()->id));
                })->exists();  

        }
        else
        {
            return $this->views()->where('ip', '=',  request()->ip())->exists();
        }
    }

    public function feature(){
        return $this->morphOne(Feature::class, 'featurable');
    }

    public function isFeatured($id){
        return $this->feature()->where('featurable_id', $id)->exists();
    }
    

    public function serviceCategory(){
        return $this->belongsTo(ServiceCategory::class);
    }
}
