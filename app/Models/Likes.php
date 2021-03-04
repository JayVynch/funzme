<?php

namespace App\Models;

use App\Models\User;
use App\Models\Posts;
use Illuminate\Database\Eloquent\Model;
// use App\Traits\UsesUuids;


class Likes extends Model
{
    
    protected $table = 'likeables';

    protected $guarded = [];

    public function likeable(){
    	return $this->toMorph();
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

}
