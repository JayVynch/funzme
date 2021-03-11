<?php

namespace App\Actions\Like;

use App\Models\User;
use App\Models\Posts;
use App\Models\Comment;

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

    public function destroyCommentLike($commentId){
        $comment = Comment::whereId($commentId)->first();
        // dd($comment);
        if(!$comment){
            return response()->json(['message' => 'sorry could not find comment']);
        }

        $comment->unLike();

        // broadcast( new destroyCommentLike ($comment));

        return response()->json(['unLike' => $comment->isLiked]);
    }
}