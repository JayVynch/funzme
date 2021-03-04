<?php

namespace App\Models;

use App\Models\User;
use App\Models\Likes;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
// use App\Traits\UsesUuids;


class Posts extends Model
{
    protected $table = 'posts';

    protected $guarded = [];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function PostImages(){
        return $this->images ? asset("images/posts/".$this->images) : "";
    }

    public function likes(){
        return $this->morphMany('App\Models\Like','likeables');
    }

    public function comments(){
        return $this->morphMany('App\Models\Comment','commentable');
    }

    public function like(){
        $attributes = [
            'user_id' => Auth::id(),
        ];
        if( !$this->likes()->where($attributes)->exists()){
           $this->likes()->create($attributes);    
        }
    }

    public function unLike(){
       
        $this->likes()->where('user_id',Auth::user()->lawyer->id)->delete();    
        
    }

    public function isLiked(){
        return $this->likes()->where('user_id',Auth::user()->lawyer->id)->count();
    }

    public function getIsLikedAttribute(){
        return $this->likes()->where('user_id',Auth::user()->lawyer->id)->exists();    
    }

}
