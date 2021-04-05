<?php

namespace App\Models;

use App\Models\User;
// use App\Traits\UsesUuids;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{

    protected $table = 'follows';

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $guarded = ['id','created_at','updated_at'];

    public function user(){
        return $this->belongsTo(User::class,'sender_id','id');
    }

	public function sender(){
		return $this->morpTo('sender');
	}

	public function receiver(){
		return $this->morpTo('receiver');
	}

	 /**
     * @param Model $recipient
     * @return $this
     */
    public function fillRecipient($recipient)
    {
        return $this->fill([
            'receiver_id' => $recipient->getKey(),
            'receiver_type' => $recipient->getMorphClass()
        ]);
    }
    /**
     * @param $query
     * @param Model $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereRecipient($query, $model)
    {
        return $query->where('recipient_id', $model->getKey())
            ->where('recipient_type', $model->getMorphClass());
    }
    /**
     * @param $query
     * @param Model $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereSender($query, $model)
    {
        return $query->where('sender_id', $model->getKey())
            ->where('sender_type', $model->getMorphClass());
    }

    /**
     * @param $query
     * @param Model $sender
     * @param Model $recipient
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBetweenUsers($query, $sender, $recipient)
    {
        $query->where(function ($queryIn) use ($sender, $recipient){
            $queryIn->where(function ($q) use ($sender, $recipient) {
                $q->whereSenderId($sender->id)->whereReceiverId($recipient->id);
            })->orWhere(function ($q) use ($sender, $recipient) {
                $q->whereSenderId($recipient->id)->whereReceiverId($sender->id);
            });
        });
    }

    /**
     * @param $query
     * @param Model $sender
     * @param Model $recipient
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBetweenUser($query, $sender, $recipient)
    {
        $query->where(function ($queryIn) use ($sender, $recipient){
            $queryIn->whereSenderId($sender->id)->whereReceiverId($recipient->id);
        });
    }


}
