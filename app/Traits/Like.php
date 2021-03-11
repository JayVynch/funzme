<?php

namespace App\Traits;

use Auth;

trait Like{

	public function like(){
        $attributes = [
            'user_id' => Auth::id(),
        ];
        if( !$this->likes()->where($attributes)->exists()){
           return $this->likes()->create($attributes);    
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