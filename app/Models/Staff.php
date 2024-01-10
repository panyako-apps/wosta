<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staffs';

    protected $fillable = [

        'user_id',
        'name',
        'slug',
        'title',
        'description',
        'image',
        'email',
        'job_title',
        'isFeatured',
        'isPublished',
        'published_by',
        'published_at',
        'updated_by',
    ];

    public function images(){
        return $this->morphMany(Image::class, 'imageable');
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

}
