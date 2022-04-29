<?php

namespace App\Actions\Like;

use App\Models\User;
use App\Models\Posts;
use App\Models\Comment;
use App\Models\NotifiableActivities;
use App\Events\DeleteNotificationEvent;

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

        // $notify = $post->user->notifications()->where(function($query) use ($notification){
        //     $query->where(function ($q) use ($notification) {
        //         $q->read()->whereId($notification->notification_id);
        //     })->orWhere(function ($q) use ($notification) {
        //         $q->unread()->whereId($notification->notification_id);
        //     });
        // })->first();

        broadcast( new DeleteNotificationEvent($notification));
        
        // $notify?->delete();

        $notification?->delete();
        
        $post->unLike();

        return response()->json(['unLike' => $post->isLiked]);
    }

    public function destroyCommentLike($commentId){
        $comment = Comment::whereId($commentId)->first();
        
        if(!$comment){
            return response()->json(['message' => 'sorry could not find comment']);
        }

        $notification = NotifiableActivities::where('noticeable_id', $commentId)
                        ->where('user_id',auth()->id())->first();

        $comment->unLike();

        // $comment->commenter->notifications()->whereId($notification->notification_id)->delete();

        event( new DeleteNotificationEvent($notification));
        // broadcast( new destroyCommentLike ($comment));

        return response()->json(['unLike' => $comment->isLiked]);
    }
}