<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CommentController extends Controller
{

    public function index($id){
        return Inertia::render('Post/Comment',[
                'postWithComments' => Posts::whereId($id)->first() 
            ]
        );
    }

    public function store(Request $request){
        
        $this->validate($request,[
            'comment' => 'required|string'
        ]);

        $post = Posts::whereId($request->postId)->first();

        if(!$post){
            return redirect()->back();
        }

        $comment = $post->comments()->create([
            'comment' => $request->comment,
            'user_id' => auth()->id()
        ]);

        $authComment = auth()->user()->comments()->save($comment);

        // if( auth()->id() != $comment->commenter->id){
        //     $post->owner->user->notify(new CommentsNotification($comment));
        // }

        // broadcast( new CommentPostEvent($comment));
        // broadcast( new NotificationsEvent(auth()->user()->unreadNotifications()->count()));
        
        return response()->json(['message' => $comment ]);
    }
}
