<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['sender', 'receiver', 'message','photos'];

    public function sender()
    {
        return $this->belongsTo(User::class,'sender');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class,'receiver');
    }

}
