<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Posts;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

    	return Inertia::render('Dashboard',[ 

    		'user' => auth()->user()
	    ]);
    }

    public function userPage($user){

    	$user = User::whereUsername($user)->first();

    	return Inertia::render('Post/Profile',[ 

    		'tweets' => Posts::with('user')->where(function($query) use ($user) {
				            return $query->where('user_id', $user->id)
				            ->orWhereIn('user_id', $user->getFriends()->pluck('id'));
				        })            
				        ->latest()
				        ->get(),
			'profiler' => $user
	    ]);
    }

    public function notifications(){
       $notifications = auth()->user()->unreadNotifications()->limit(10)->get()->toArray();

       return response()->json(['notifications' => $notifications ]);
    }

    public function markNotificationAsRead(Request $request){

        $notification = auth()->user()->unreadNotifications()->whereId($request->id)->first();

        $notification->markAsRead();

        return response()->json(['notifications' => 'marked as read' ]);
    }
}
