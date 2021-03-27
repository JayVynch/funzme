<?php

namespace App\Actions\Like;

use App\Models\User;
use App\Models\Posts;
use App\Models\Comment;
use App\Models\NotifiableActivities;

/**
*  Responsible for deleting a like of a post
*/
class DeleteLike 
{
	
	public function destroyLike($postId){
        $post = Posts::whereId($postId)->first();

        $notification = NotifiableActivities::where('noticeable_id', $postId)
                        ->where('user_id',auth()->id())->first();

        if(!$post){
            return response()->json(['message' => 'sorry could not find post']);
        }

        $post->unLike();

        $post->user->notifications()->whereId($notification->notification_id)->delete();

        return response()->json(['unLike' => $post->isLiked]);
    }

    public function destroyCommentLike($commentId){
        $comment = Comment::whereId($commentId)->first();
        // dd($comment);
        if(!$comment){
            return response()->json(['message' => 'sorry could not find comment']);
        }

        $notification = NotifiableActivities::where('noticeable_id', $commentId)
                        ->where('user_id',auth()->id())->first();

        $comment->unLike();

        $comment->user->notifications()->whereId($notification->notification_id)->delete();
        // broadcast( new destroyCommentLike ($comment));

        return response()->json(['unLike' => $comment->isLiked]);
    }
}