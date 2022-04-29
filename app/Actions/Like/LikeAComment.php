<?php

namespace App\Actions\Like;

use App\Models\Comment;
use App\Models\NotifiableActivities;
use App\Models\User;
use App\Notifications\LikeNotification;

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

        if(auth()->id() != $comment->commenter->id){

            $comment->commenter->notify( new LikeNotification($comment));

            $notisme = $comment->commenter->unreadNotifications()->get();

            $notisme->last( function($value) use ($comment){
            
                (new NotifiableActivities)->fillNoticeables($comment,$value->data['id']);
            });

        }

        return response()->json(['liked' => $comment->isLiked]);
    }
}