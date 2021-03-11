<?php

namespace App\Actions\Like;

use App\Models\User;
use App\Models\Comment;

/**
* 	create a like from a post which the user liked
*/
class LikeAComment 
{
	
	public function commentLike($commentId){

        $comment = Comment::whereId($commentId)->first();

        if(!$comment){
            return redirect()->back();
        } 

        $like = $comment->like();

        // broadcast( new LikeAComment ($comment));

        // if(Auth::user()->lawyer->id != $comment->owner->id){
        //     $comment->owner->user->notify( new LikesNotification($comment));
        // }

        // broadcast( new NotificationsEvent(auth()->user()->unreadNotifications()->count()));

        return response()->json(['liked' => $comment->isLiked]);
    }
}