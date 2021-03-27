<?php
namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
* 
*/
class NotifiableActivities extends Model
{
	protected $table = 'notifiableactivities';

	protected $fillable = [
		'user_id',
		'notification_id',
		'noticeable_id',
		'noticeable_type'
	];

	public function noticeable(){
		return $this->morpTo('noticeable');
	}
	
	public function fillNoticeables($notice, $notification)
    {
        return $this->create([
            'noticeable_id' => $notice->getKey(),
            'noticeable_type' => $notice->getMorphClass(),
            'user_id' => auth()->id(),
            'notification_id' => $notification
        ]);
    }

    public function updateNoticeables($notice)
    {
        $this->update([
            'notification_id' => $notice,
        ]);

        return true;
    }
}