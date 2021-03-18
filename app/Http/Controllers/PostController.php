<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Http\File;
use App\Actions\Like\LikeAPost;
use App\Actions\Like\DeleteLike;
use Illuminate\Support\Facades\Storage;
use App\Events\NewPost;

class PostController extends Controller
{

    /**
     * UserController constructor.
     * @param $pathToProfileImage
     */
    public function __construct() // 'message'   => $this->notification->.' Accepted your  Link Request ',
            // 'link' => '/follow'
    {
        $this->middleware(['auth:sanctum']);
    }

    public function index(){

        $tweets = Posts::with('user')->where(function($query) {
                            return $query->where('user_id', auth()->id())
                            ->orWhereIn('user_id',auth()->user()->getFriends()->pluck('id'));
                        })            
                        ->latest()
                        ->get();
        return response()->json(['data' => $tweets]);
    }

    public function store(Request $request){

    	$this->validate($request,[
            'post' => 'string|nullable',
            'post_image' => 'image|nullable'
        ]);

        $path = null; // 'message'   => $this->notification->.' Accepted your  Link Request ',
            // 'link' => '/follow'
        $post = '';

        if ($request->post) {
            $post = $request->post;
        }

        if($request->hasFile('post_image')){
            $path = Storage::putFile('public/images/posts', $request->file('post_image'));
        } 

        $strings = $path ? explode('/', $path) : null;

        $image = $strings ? $strings[3] : null;

        $post = auth()->user()->posts()->create([
            'tweets' => $post,
            'post_photos' => $image
        ]);

        broadcast(new NewPost($post));

        return redirect()->back();
    }

    public function addLike(Request $request){

       $like = (new LikeAPost)->postLike($request->postId);

       return response()->json(['data' => $like]);
    }

    public function unLike($postId){

        $like = (new DeleteLike)->destroyLike($postId);

        return response()->json(['data' => $like]);
    }
}
