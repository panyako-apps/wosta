<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'sections',
        'isFeatured',
        'isPublished',
        'published_by',
        'published_at',
    ];

    // Mutator to ensure the structure of each section
    public function setSectionsAttribute($value)
    {
        foreach ($value as $section) {
            if (
                !isset($section['name'])) 
                {
                throw new \InvalidArgumentException('Each section must have name');
            }

            // Remove any extra fields from each section
            // $section = array_intersect_key($section, array_flip(['title', 'description', 'image']));
        }

        $this->attributes['sections'] = json_encode($value);
    }

    // Accessor to decode JSON when retrieving sections
    public function getSectionsAttribute($value)
    {
        return json_decode($value, true);
    }

    public function views()
    {
        return $this->morphMany(View::class, 'viewable');
    }

}
