<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

        
    protected $fillable =[
        'viewable_id', 
        'viewable_type', 
        'url', 
        'session_id', 
        'user_id', 
        'ip', 
        'agent', 
    ];

    public function viewable()
    {
        return $this->morphTo();
    }
    
}
