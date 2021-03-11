<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Posts;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

    	return Inertia::render('Dashboard',[ 

    		'tweets' => Posts::where(function($query) {
				            return $query->where('user_id', auth()->id())
				            ->orWhereIn('user_id',auth()->user()->getFriends()->pluck('id'));
				        })            
				        ->latest()
				        ->get()
	    ]);
    }
}
