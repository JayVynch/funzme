<?php 

namespace App\Actions\Post;

use App\Models\Comment;
use App\Models\Likes;
use App\Models\Posts;


class DeletePost 
{
	
	public function __invoke($post) :void
	{
		$postComments = Comment::where('commentable_id', $post)->get();

		if($postComments){
			$postComments->map(function($comment){
				return $comment->delete();
			});
		}

		$postLikes = Likes::where('likeable_id',$post)->get();

		if($postLikes){
			$postLikes->map(function($like){
				return $like->delete();
			});
		}

		Posts::where('id',$post)->delete();

		return;
	}
}