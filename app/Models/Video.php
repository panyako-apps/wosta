<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    
    protected $fillable =[
        'code',
        'keywords',
        'isFeatured',
        'isPublished',
        'published_by',
        'published_at',
        'updated_by',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

}
