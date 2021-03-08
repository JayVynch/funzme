<?php

namespace App\Models;

use Auth;
use App\Models\User;
use App\Models\Likes;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
// use App\Traits\UsesUuids;


class Posts extends Model
{
    protected $table = 'posts';

    protected $fillable = ['tweets','post_photos'];

    protected $appends = ['postUrl'];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function getPostUrlAttribute(){
        return $this->post_photos ? asset("storage/images/posts/".$this->post_photos) : "";
    }

    // public function getPostUrlAttribute(){
    //     return $this->postImage();
    // }

    public function likes(){
        return $this->morphMany('App\Models\Likes','likeables');
    }

    public function comments(){
        return $this->morphMany('App\Models\Comment','commentable');
    }

    public function like(){
        $attributes = [
            'user_id' => Auth::id(),
        ];
        if( !$this->likes()->where($attributes)->exists()){
           return $this->likes()->create($attributes);    
        }
    }

    // public function unLike(){
       
    //     return $this->likes()->where('user_id',Auth::user()->lawyer->id)->delete();    
        
    // }

    // public function isLiked(){
    //     return $this->likes()->where('user_id',Auth::user()->lawyer->id)->count();
    // }

    // public function getIsLikedAttribute(){
    //     return $this->likes()->where('user_id',Auth::user()->lawyer->id)->exists();    
    // }

}
