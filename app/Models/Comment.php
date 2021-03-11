<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Like;


class Comment extends Model
{
	use Like;
	
 	protected $table = 'comments';
 	
    protected $fillable = ['user_id', 'reply', 'comment_upload'];

    protected $with = ['commenter'];

    protected $withCount = ['likes'];

    protected $appends = ['isLiked','commentUrl'];

    public function commentable(){
    
    	return	$this->toMorphs();
    }

    public function commenter(){
    	return $this->belongsTo(User::class,'user_id');
    }

    public function likes(){
        return $this->morphMany('App\Models\Likes','likeable');
    }

    public function getCommentUrlAttribute(){
        return $this->comment_upload ? asset("storage/images/comments/".$this->comment_upload) : "";
    }

}
