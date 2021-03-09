<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Http\File;
use App\Actions\Like\LikeAPost;
use App\Actions\Like\DeleteLike;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    /**
     * UserController constructor.
     * @param $pathToProfileImage
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(){

        return response()->json(['data' => Posts::whereUserId(auth()->id())->get()]);
        // return Inertia::render('Post/Feeds',[
        //     'posts' => Posts::whereUserId(auth()->id())->get()
        // ]);
    }

    public function store(Request $request){

    	$this->validate($request,[
            'post' => 'string|nullable',
            'post_image' => 'image|nullable'
        ]);

        $path = null;
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
