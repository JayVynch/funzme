<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Events\NewChatMessage;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(){

    	return Inertia::render('Chat/Index',[ 

    		'user' => auth()->user()
	    ]);
    }

    public function store(Request $request){

    	$this->validate($request,[
    		'message' => 'string'
    	]);

    	$message = Chat::create([
    		'sender' => auth()->id(),
    		'receiver' => $request->contact_id,
    		'message' => $request->message
    	]);

    	broadcast(new NewChatMessage($message));

    	return response()->json(['message' => 'message sent']);
    }

    public function getContacts($id){

    	$contacts = auth()->user()->getFriends();

    	return response()->json(['contacts' => $contacts ]);
    }

    public function userDirectMessages($id){

    	$auth = auth()->id();

    	$messages = Chat::where(function($q) use ($id,$auth){
		  	$q->where('sender',$auth);
		  	$q->where('receiver',$id);
		})
		  	->orWhere(function ($q) use ($id,$auth){
		  	$q->where('sender',$id);
		  	$q->where('receiver',$auth);
		})
		->orderBy('created_at','asc')
		->get();

		
	  	return response()->json($messages);
    }
}
