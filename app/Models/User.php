<?php

namespace App\Models;

use App\Models\Posts;
use App\Models\Comment;
use App\Models\NotifiableActivities;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\Followers;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Followers;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'isFollower',
        'isFollowing',
        'countFollower',
        'countFollowing'
    ];

    public function posts(){
        return $this->hasMany(Posts::class,'user_id');
    }

    public function comments(){
      return $this->hasMany(Comment::class,'user_id');
    }

    public function follower(){
      return $this->hasMany(Follow::class,'receiver_id');
    }

    public function following(){
      return $this->hasMany(Follow::class,'sender_id');
    }

    public function getIsFollowerAttribute(){
        return $this->follower()->exists();  
    }

    public function getIsFollowingAttribute(){
        return $this->following()->exists();  
    }

    public function getCountFollowerAttribute(){
        return $this->follower()->count();  
    }

    public function getCountFollowingAttribute(){
        return $this->following()->count();  
    }

    public function notice(){
        return $this->hasMany(NotifiableActivities::class,'user_id');
    }
}
