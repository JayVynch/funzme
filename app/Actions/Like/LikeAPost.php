<?php

namespace App\Actions\Like;

use App\Models\User;
use App\Models\Posts;
use App\Notifications\LikeNotification;
use App\Models\NotifiableActivities;

/**
* 	create a like from a post which the user liked
*/
class LikeAPost 
{
	
	public function postLike($postId){

        $post = Posts::whereId($postId)->first();

        if(!$post){
            return redirect()->back();
        } 

        $like = $post->like();

        if(auth()->id() != $post->user->id){

            $post->user->notify( new LikeNotification($post));

            $notisme = $post->user->unreadNotifications()->get();

            $notisme->last( function($value) use ($post){
            
                (new NotifiableActivities)->fillNoticeables($post,$value->data['id']);
            });

        }

        // broadcast( new NotificationsEvent(auth()->user()->unreadNotifications()->count()));

        return response()->json(['liked' => $post->isLiked]);
    }
}