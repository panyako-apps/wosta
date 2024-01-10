<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'title',
        'job_title',
        'testimony',
        'image',
        'isFeatured',
        'isPublished',
        'published_by',
        'published_at',
        'updated_by'
    ];

    public function user()
    {
        return $this>belongsTo(User::class);
    }
}
