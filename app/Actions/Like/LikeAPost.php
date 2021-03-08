<?php

namespace App\Actions\Like;

use App\Models\User;
use App\Models\Posts;

/**
* 	create a like from a post which the user liked
*/
class LikeAPost 
{
	
	public function postLike($postId){

        $post = Posts::whereId($postId)->first();

        if(!$post){
            return redirect()->route('home');
        } 

        $like = $post->like();

        broadcast( new LikeAPost ($post));

        if(Auth::user()->lawyer->id != $post->owner->id){
            $post->owner->user->notify( new LikesNotification($post));
        }

        broadcast( new NotificationsEvent(auth()->user()->unreadNotifications()->count()));

        return response()->json(['liked' => $post->isLiked]);
    }
}