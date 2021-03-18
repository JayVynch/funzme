<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Actions\Like\LikeAComment;
use App\Actions\Like\DeleteLike;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Events\NewComment;
use App\Notifications\CommentNotification;

class CommentController extends Controller
{
    public function __construct(){
        $this->middleware(['auth:sanctum']);
    }

    public function index($id){
        return Inertia::render('Post/Comment',[
                'postWithComments' => Posts::with('user')->whereId($id)->first() 
            ]
        );
    }

    public function store(Request $request){

        $this->validate($request,[
            'reply' => 'string|nullable',
            'comment_image' => 'image|nullable'
        ]);

        $path = null;
        $reply = '';

        $post = Posts::whereId($request->postId)->first();

        if(!$post){
            return redirect()->back();
        }

        if ($request->reply) {
            $comment = $request->reply;
        }

        if($request->hasFile('comment_image')){
            $path = Storage::putFile('public/images/comments', $request->file('comment_image'));
        } 

        $strings = $path ? explode('/', $path) : null;

        $image = $strings ? $strings[3] : null;

        $comment = $post->comments()->create([
            'reply' => $comment,
            'user_id' => auth()->id(),
            'comment_upload' => $image
        ]);

        broadcast(new NewComment($comment));

        $authComment = auth()->user()->comments()->save($comment);

        if( auth()->id() != $comment->commenter->id){
            $post->user->notify(new CommentNotification($comment));
        }

        // broadcast( new CommentPostEvent($comment));
        // broadcast( new NotificationsEvent(auth()->user()->unreadNotifications()->count()));
        
        return redirect()->back();
    }

    public function addLike(Request $request){

       $like = (new LikeAComment)->commentLike($request->postId);

       return response()->json(['data' => $like]);
    }

    public function unLike($postId){

        $like = (new DeleteLike)->destroyCommentLike($postId);

        return response()->json(['data' => $like]);
    }
}
