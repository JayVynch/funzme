<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
// use App\Traits\UsesUuids;


class Comment extends Model
{
 	
    protected $fillable = ['user_id', 'comment'];

    protected $with = ['commenter'];

    public function commentable(){
    
    	return	$this->toMorphs();
    }

    public function commenter(){
    	return $this->belongsTo(User::class);
    }

}
