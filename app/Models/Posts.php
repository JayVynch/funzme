<?php

namespace App\Models;

use Auth;
use App\Models\User;
use App\Models\Likes;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Like;


class Posts extends Model
{
    use Like;
    
    protected $table = 'posts';

    protected $fillable = ['tweets','post_photos'];

    protected $appends = ['isLiked','postUrl'];

    protected $with = ['comments','user'];
    
    protected $withCount = ['likes','comments'];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function getPostUrlAttribute(){
        return $this->post_photos ? asset("storage/images/posts/".$this->post_photos) : "";
    }

    public function likes(){
        return $this->morphMany('App\Models\Likes','likeable');
    }

    public function comments(){
        return $this->morphMany('App\Models\Comment','commentable');
    }

    

}
