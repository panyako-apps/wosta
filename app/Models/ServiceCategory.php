<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'parent_id',
        'name',
        'image',
        'slug',
        'isFeatured',
        'isPublished',
        'published_by',
        'published_at',
        'updated_by',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function services(){
        return $this->hasMany(Service::class);
    }

    
    public function subCategories(){
        return $this->hasMany(ServiceCategory::class, 'parent_id');
    }    
}
