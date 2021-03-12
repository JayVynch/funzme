<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchUser(Request $request){
        $query = $request->keyword;

        $search = User::where('name','LIKE','%'.$query.'%')
                    ->get();

        if(!$search){
            exit();
        }

        // $result =  $search->reject( function($user){
        //     return $user->isFriendWith(Auth::user());
        // });

        return response()->json(['users' => $search]);
    }
}
