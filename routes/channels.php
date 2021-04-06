<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('newPosting', function($user){
	// return ($user->isFriendWith(auth()->user()) || ((int) $user->id === (int) $id));
	return $user;
});

Broadcast::channel('newCommenting', function($user){
	// return ($user->isFriendWith(auth()->user()) || ((int) $user->id === (int) $id));
	return $user;
});

Broadcast::channel('Deleting',function ($user){
	return $user;
});

Broadcast::channel('dm.{id}',function ($user,$id){
	return (int) $user->id === (int) $id;
});