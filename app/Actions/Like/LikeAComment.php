<?php

namespace App\Actions\Like;

use App\Models\User;
use App\Models\Comment;

/**
* 	create a like from a comment which the user liked
*/
class LikeAComment 
{
	
	public function commentLike($commentId){

        $comment = Comment::whereId($commentId)->first();

        if(!$comment){
            return redirect()->back();
        } 

        $like = $comment->like();

        if(auth()->id() != $comment->user->id){

            $comment->user->notify( new LikeNotification($comment));

            $notisme = $comment->user->unreadNotifications()->get();

            $notisme->last( function($value) use ($comment){
            
                (new NotifiableActivities)->fillNoticeables($comment,$value->data['id']);
            });

        }

        return response()->json(['liked' => $comment->isLiked]);
    }
}