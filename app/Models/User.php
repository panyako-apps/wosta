<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'provider',
        'provider_id',
        'provider_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


           /**
    *
    *Create User Profile on User Registration
    *
    *
    */
    protected static function boot()
    {
        parent::boot();
        static::created(function($user){
            $user->userProfile()->create([
                'profileimage'=>'avatar.jpg'
            ]);

        });
    }

    public function userProfile(){
        return $this->hasOne(UserProfile::class);
    }

    public function projectCategories(){
        return $this->hasMany(ProjectCategory::class);
    }

    public function projects(){
        return $this->hasMany(Project::class);
    }
    
    public function staffMembers(){
        return $this->hasMany(Staff::class);
    }
    
    public function testimonials(){
        return $this->hasMany(Testimonial::class);
    }
    
    public function publishedPosts(){
        return $this->hasMany(Post::class)->where('isPublished', true);
    }

    public function services(){
        return $this->hasMany(Service::class);
    }

    public function serviceCategories(){
        return $this->hasMany(ServiceCategory::class);
    }

    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function videos(){
        return $this->hasMany(Video::class);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }
  
    public function postCategories(){
        return $this->hasMany(PostCategory::class);
    }

    public function pages(){
        return $this->hasMany(Page::class);
    }

    /**USER ROLES*/

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    
    /**
     * Check if user has a role
     * @param string $role
     * @return bool 
     */
    public function hasAnyRole(string $role){
        return null !== $this->roles()->where('name', $role)->first(); 
    }
    
    /**
     * Check if user has any given role
     * @param Array $role
     * @return bool 
     */
    public function hasAnyRoles(array $role){
        return null !== $this->roles()->whereIn('name', $role)->first(); 
    }


    
}
