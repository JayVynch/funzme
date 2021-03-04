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

    public function getAdd($email){

    	$lawyer = Lawyer::find($email);

        if(!$lawyer){
    		return redirect()->route('home');
    	}

    	//cannot add yourself
    	if(Auth::user()->lawyer->id == $lawyer->id){
    		return redirect()->route('home');
    	}

    	if(Auth::user()->lawyer->hasFollowRequestPending($lawyer) || $lawyer->hasFollowRequestPending(Auth::user()->lawyer)){
    		session()->flash('info','You are already linked each other');
            return redirect()->route('home');
    	}

    	Auth::user()->lawyer->befriend($lawyer);

        $lawyer->user->notify(new LinkNotification(Auth::user()));

    	return response()->json('Request Sent');
    }

    public function getAccepted($email){
    	$lawyer = Lawyer::whereId($email)->first();

        // return $lawyer;
    	if(!$lawyer){
      		return response()->json('The User could not be found on our Database');
    	}

    	if(Auth::user()->lawyer->isFriendWith($lawyer)){
    		return response()->json('You already accepted this Request');
    	}

        
    	Auth::user()->lawyer->acceptFollowRequest($lawyer);
        $lawyer->user->notify(new AcceptLinkNotification(Auth::user()));

        return response()->json('Linkup Successful');
    }

    public function unlink($email){
        $user = User::where('id',$email)->first();

        if(!$user){
            return redirect()->route('home')->with('info', 'The User could not be found on our Database');
        }

        Auth::user()->removeFollower($user);

        return response()->json('Unlinked');
    }

    public function getRequest(){
        $requests   = Auth::user()->lawyer->getFriendRequests();

        $firm       = Firm::where('user_id', Auth::user()->lawyer->id)->first();
        $status     = Status::where('user_id',Auth::user()->lawyer->id)->first();
        $groups     = Auth::user()->lawyer->getGroupNames();

        if(request()->expectsJson()){
            return response()->json(['requests' => $requests ]);
        }

        return view('follows.request', compact('requests','status','firm','groups'));
    }

    public function links($id){

        $lawyer = Lawyer::find($id);

        $links = $lawyer->getFriends(10);

        $firm = Firm::where('user_id', Auth::user()->lawyer->id)->first();
        $status = Status::where('user_id',Auth::user()->lawyer->id)->first();
        $groups     = Auth::user()->lawyer->getGroupNames();

        if(request()->expectsJson()){
            return response()->json(['linkz' => $links ]);
        }

        return view('follows.links',compact('links','firm','status','groups'));  
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
            return !$user->lawyer->isFriendWith(Auth::user()->lawyer);
        });

        return response()->json($result);
    }

    public function getMutualLinks(){

        $fof = Auth::user()->lawyer->getFriendsOfFriends(3);

        foreach(Auth::user()->lawyer->getFriends() as $recommended){
            
            return response()->json(['mutualsLinkz' => Auth::user()->lawyer->getMutualFriends($recommended, 3), 'fof' => $fof ]);
        } 
    }
}


