<?php

namespace App\Actions\Like;

use App\Models\User;
use App\Models\Posts;

/**
*  Responsible for deleting a like of a post
*/
class DeleteLike 
{
	
	public function destroyLike($postId){
        $post = Posts::whereId($postId)->first();
        // dd($post);
        if(!$post){
            return response()->json(['message' => 'sorry could not find post']);
        }

        $post->unLike();

        // broadcast( new LikeAPost ($post));

        return response()->json(['unLike' => $post->isLiked]);
    }
}