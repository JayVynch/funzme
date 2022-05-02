<?php

namespace App\Http\Controllers;

/*
** This is a controller for adding followers. It checkes if
** user is already being followed else if tries to make 
** both of them have a connection.
** @method getAdd($email), getAccept($email)
*/
use Auth;
use App\Models\User;
// use App\Model\Status;
use Illuminate\Http\Request;
use App\Notifications\GeneralNotification;
// use App\Notifications\AcceptLinkNotification;


class FollowController extends Controller
{   
    public function __construct(){
        return $this->middleware('auth:sanctum');
    }

    public function followIndex(){
        $followers = Auth::user()->getFriends(12);
        
        if(request()->expectsJson()){

            return response()->json(['linkz' => $followers ]);
        }

        // return view('follows.index', compact('followers'));
    }

    public function getFollowed($email){

    	$following = User::whereEmail($email)->first();


        if(!$following){
            return redirect()->back();
        }

        // cannot add yourself
        if(Auth::id() == $following->id){
            return redirect()->back();
        }   


        if(Auth::user()->hasFollowingRequestPending($following)){
            session()->flash('info','You are already sent a follow request');
            return redirect()->back();
        }

        if (!Auth::user()->isFriendWith($following)) {
            Auth::user()->befriend($following); 

            $following->acceptFollowRequest(Auth::user());
        }

        $following->notify(new GeneralNotification(auth()->user()));

    	return response()->json(['message' => 'Request Sent']);
    }

    public function unFollow($email){

        $user = User::whereEmail($email)->first();

        dd($user->follower()->first());

        if(!$user){
            return redirect()->route('dashboard')->with('error', 'The User could not be found on our Database');
        }

        Auth::user()->unfriend($user);

        return response()->json(['message' => 'unFollowed']);
    }

    public function links($id){

        $user = User::WhereId($id)->first();

        $links = $user->getFriends(10);

        if(request()->expectsJson()){
            return response()->json(['linkz' => $links ]);
        }
    }

}


