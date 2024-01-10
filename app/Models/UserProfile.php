<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'profileimage',
        'avatar',
        'description',
        'phone',
        'username',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
