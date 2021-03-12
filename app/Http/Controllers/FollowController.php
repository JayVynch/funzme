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
// use App\Notifications\LinkNotification;
// use App\Notifications\AcceptLinkNotification;


class FollowController extends Controller
{   
    public function __construct(){
        return $this->middleware('auth');
    }

    public function followIndex(){
        $followers = Auth::user()->lawyer->getFriends(12);
        $groups     = Auth::user()->lawyer->getGroupNames();
        $firm = Firm::where('user_id', Auth::user()->lawyer->id)->first();
        $status = Status::where('user_id',Auth::user()->lawyer->id)->first();

        if(request()->expectsJson()){

            return response()->json(['linkz' => $followers ]);
        }

        return view('follows.index', compact('followers','firm','status','groups'));
    }

    public function getFollowed($email){

    	$following = User::whereEmail($email)->first();

        if(!$following){
    		return redirect()->route('home');
    	}

    	//cannot add yourself
    	if(Auth::id() == $following->id){
    		return redirect()->back();
    	}

    	if(Auth::user()->hasFollowRequestPending($following) || $following->hasFollowRequestPending(Auth::user())){
    		session()->flash('info','You are already linked each other');
            return redirect()->back();
    	}

    	Auth::user()->befriend($following);

        $following->acceptFollowRequest(Auth::user());

    	return response()->json(['message' => 'Request Sent']);
    }

    public function unFollow($email){
        $user = User::whereEmail($email)->first();

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

    public function searchLinkz(Request $request){
        $query = request('query');

        $search = User::where('firstname','LIKE','%'.$query.'%')
                    ->orWhere('lastname','LIKE','%'.$query.'%')
                    ->get();

        if(!$search){
            exit();
        }

        $result =  $search->reject( function($user){
            return !$user->isFriendWith(Auth::user());
        });

        return response()->json($result);
    }
}


