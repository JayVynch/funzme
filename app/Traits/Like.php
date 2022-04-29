<?php

namespace App\Traits;

use Auth;

trait Like{

	public function like(){
    
        if( !$this->likes()->where('user_id',Auth::id())->exists()){
           return $this->likes()->create([ 'user_id' => Auth::id() ]);    
        }
    }

    public function unLike(){
       
        return $this->likes()->where('user_id',Auth::id())->delete();    
        
    }

    public function isLiked(){
        return $this->likes()->where('user_id',Auth::id())->count();
    }

    public function getIsLikedAttribute(){
        return $this->likes()->where('user_id',Auth::id())->exists();    
    }
}	