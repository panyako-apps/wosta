<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    protected $fillable = [
        'commentable_type',
        'commentable_id',
        'name',
        'email',
        'user_id',
        'comment',
        'parent_id',
        'isFeatured',
        'isPublished',
    ];

        /**
     * Convert created_at to time difference.
     *
     * @param  string  $value
     * @return string
     */
    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->diffForHumans();
    }
    
    protected static function boot()
    {
        parent::boot();
     
        // Set default model order -  by created_at in a descending order
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('created_at', 'DESC');
        });
    }
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function likes(){
        return $this->morphMany(Like::class, 'likeable');
    } 

    public function comments(){
        return $this->morphMany(Comment::class, 'commentable')->whereNotNull('parent_id');
    }

    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }
 
}
