<?php

namespace App\Traits;

use App\Models\User;
use App\Models\Follow;
use App\Models\FollowStatus;

trait Followers {

	/**
     * @param Model $recipient
     *
     * @return Follow\Models\
    */
    
    public function befriend(Lawyer $recipient)
    {
        if (!$this->canBefriend($recipient)) {
            return false;
        }
        $friendship = (new Follow)->fillRecipient($recipient)->fill([
            'status' => FollowStatus::PENDING,
        ]);
        $this->follows()->save($friendship);
      
        // Event::fire('friendships.sent', [$this, $recipient]);
        return $friendship;
    }
    
    /**
     * @param Lawyer $recipient
     *
     * @return bool
     */
    public function unfriend(Lawyer $recipient)
    {
        $deleted = $this->findFriendship($recipient)->delete();
        // Event::fire('friendships.cancelled', [$this, $recipient]);
        return $deleted;
    }
    
    /**
     * @param Lawyer $recipient
     *
     * @return bool
     */
    public function hasFollowRequestPending(Lawyer $recipient)
    {
        return $this->findFriendship($recipient)->whereSenderId($recipient)->whereStatus(FollowStatus::PENDING)->exists();
    }
    
    /**
     * @param Lawyer $recipient
     *
     * @return bool
     */
    public function hasSentFriendRequestTo(Lawyer $recipient)
    {
        return Follow::whereReceiverId($recipient)->whereSenderId($this)->whereStatus(FollowStatus::PENDING)->exists();
    }
   
    /**
     * @param Lawyer $recipient
     *
     * @return bool
     */
    public function isFriendWith(Lawyer $recipient)
    {
        return $this->findFriendship($recipient)->where('status', FollowStatus::ACCEPTED)->exists();
    }
   
    /**
     * @param Lawyer $recipient
     *
     * @return bool|int
     */
    public function acceptFollowRequest(Lawyer $recipient)
    {
        $updated = $this->findFriendship($recipient)->whereReceiverId($this->id)->update([
            'status' => FollowStatus::ACCEPTED,
        ]);
        // Event::fire('friendships.accepted', [$this, $recipient]);
      
        return $updated;
    }
   
    /**
     * @param Lawyer $recipient
     *
     * @return bool|int
     */
    public function denyFriendRequest(Lawyer $recipient)
    {
        $updated = $this->findFriendship($recipient)->whereReceiverId($this)->update([
            'status' => FollowStatus::DENIED,
        ]);
        // Event::fire('friendships.denied', [$this, $recipient]);
      
        return $updated;
    }
    
    /**
     * @param Lawyer $recipient
     *
     * @return \Hootlex\Friendships\Lawyers\Friendship
     */
    public function blockFriend(Lawyer $recipient)
    {
        // if there is a friendship between the two users and the sender is not blocked
        // by the recipient user then delete the friendship
        if (!$this->isBlockedBy($recipient)) {
            $this->findFriendship($recipient)->delete();
        }
        $friendship = (new Friendship)->fillRecipient($recipient)->fill([
            'status' => FollowStatus::BLOCKED,
        ]);
      
        $this->follows()->save($friendship);
        // Event::fire('friendships.blocked', [$this, $recipient]);
        return $friendship;
    }
   
    /**
     * @param Lawyer $recipient
     *
     * @return mixed
     */
    public function unblockFriend(Lawyer $recipient)
    {
        $deleted = $this->findFriendship($recipient)->whereSender($this)->delete();
        // Event::fire('friendships.unblocked', [$this, $recipient]);
      
        return $deleted;
    }
    /**
     * @param Lawyer $recipient
     *
     * @return \Hootlex\Friendships\Lawyers\Friendship
     */
    public function getFriendship(Lawyer $recipient)
    {
        return $this->findFriendship($recipient)->first();
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Collection|Friendship[]
     *
     * @param string $groupSlug
     *
     */
    public function getAllFriendships($groupSlug = '')
    {
        return $this->findFriendships(null, $groupSlug)->get();
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Collection|Friendship[]
     *
     * @param string $groupSlug
     *
     */
    public function getPendingFriendships($groupSlug = '')
    {
        return $this->findFriendships(FollowStatus::PENDING, $groupSlug)->get();
    }
   
    /**
     * @return \Illuminate\Database\Eloquent\Collection|Friendship[]
     *
     * @param string $groupSlug
     *
     */
    public function getAcceptedFriendships($groupSlug = '')
    {
        return $this->findFriendships(FollowStatus::ACCEPTED, $groupSlug)->get();
    }
   
    /**
     * @return \Illuminate\Database\Eloquent\Collection|Friendship[]
     *
     */
    public function getDeniedFriendships()
    {
        return $this->findFriendships(FollowStatus::DENIED)->get();
    }
   
    /**
     * @return \Illuminate\Database\Eloquent\Collection|Friendship[]
     *
     */
    public function getBlockedFriendships()
    {
        return $this->findFriendships(FollowStatus::BLOCKED)->get();
    }
   
    /**
     * @param Lawyer $recipient
     *
     * @return bool
     */
    public function hasBlocked(Lawyer $recipient)
    {
        return $this->follows()->whereReceiverId($recipient)->whereStatus(FollowStatus::BLOCKED)->exists();
    }
   
    /**
     * @param Lawyer $recipient
     *
     * @return bool
     */
    public function isBlockedBy(Lawyer $recipient)
    {
        return $recipient->hasBlocked($this);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|Friendship[]
     */
    public function getFriendRequests()
    {
        // return $this;
        return Follow::whereReceiverId($this->id)->whereStatus(FollowStatus::PENDING)->get();
    }
    
    /**
     * This method will not return Friendship Lawyers
     * It will return the 'friends' Lawyers. ex: LexLinkz\User
     *
     * @param int $perPage Number
     * @param string $groupSlug
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFriends($perPage = 0)
    {
        return $this->getOrPaginate($this->getFriendsQueryBuilder(), $perPage);
    }
    
    /**
     * This method will not return Friendship Lawyers
     * It will return the 'friends' Lawyers. ex: LexLinkz\User
     *
     * @param int $perPage Number
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getMutualFriends($other, $perPage = 0)
    {
        return $this->getOrPaginate($this->getMutualFriendsQueryBuilder($other), $perPage);
    }
    
    /**
     * Get the number of friends
     *
     * @return integer
     */
    public function getMutualFriendsCount($other)
    {
        return $this->getMutualFriendsQueryBuilder($other)->count();
    }
    /**
     * This method will not return Friendship Lawyers
     * It will return the 'friends' Lawyers. ex: LexLinkz\User
     *
     * @param int $perPage Number
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFriendsOfFriends($perPage = 0)
    {
        return $this->getOrPaginate($this->friendsOfFriendsQueryBuilder(), $perPage);
    }
    /**
     * Get the number of friends
     *
     * @param string $groupSlug
     *
     * @return integer
     */
    public function countFollowers($groupSlug = '')
    {
        $friendsCount = $this->findFriendships(FollowStatus::ACCEPTED)->count();
        return $friendsCount;
    }
    /**
     * @param Lawyer $recipient
     *
     * @return bool
     */
    public function canBefriend($recipient)
    {
        // if user has Blocked the recipient and changed his mind
        // he can send a friend request after unblocking
        if ($this->hasBlocked($recipient)) {
            $this->unblockFriend($recipient);
            return true;
        }
        // if sender has a friendship with the recipient return false
        if ($friendship = $this->getFriendship($recipient)) {
            // if previous friendship was Denied then let the user send fr
            if ($friendship->status != FollowStatus::DENIED) {
                return false;
            }
        }
        return true;
    }

    /**
    * Get links from lawyers from the same law school
    * @param int $perPage
    * @return \Illuminate\Database\Eloquent\Collection
    */

    public function lawSchoolMates($perPage){

        $query = Lawyer::where('nls', auth()->user()->Lawyer->nls)->pluck('id')->all();

        return $this->getOrPaginate($query,$perPage);

    }

    /**
    * Get links from lawyers from the Branch
    * @param int $perPage
    * @return \Illuminate\Database\Eloquent\Collection
    */

    public function lawBranchMates($perPage){

        $query = Lawyer::where('branch', auth()->user()->Lawyer->branch)->pluck('id')->all();

        return $this->getOrPaginate($query,$perPage);
    }

    /**
    * Get links from lawyers from the same location
    * @param int $perPage
    * @return \Illuminate\Database\Eloquent\Collection
    */

    public function lawLocationMates($perPage){

        $query = Lawyer::where('location', auth()->user()->Lawyer->location)->pluck('id')->all();

        return $this->getOrPaginate($query,$perPage);
    }
  
    /**
     * @param Lawyer $recipient
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function findFriendship($recipient)
    {
        return Follow::betweenLawyers($this, $recipient);
    }
    
    /**
     * @param $status
     * @param string $groupSlug
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function findFriendships($status = null)
    {
        $query = Follow::where(function ($query) {
            $query->where(function ($q) {
                $q->whereSenderId($this->id);
            })->orWhere(function ($q) {
                $q->whereReceiverId($this->id);
            });
        });
        //if $status is passed, add where clause
        if (!is_null($status)) {
            $query->where('status', $status);
        }
        return $query;
    }
    
    /**
     * Get the query builder of the 'friend' Lawyer
     *	
     * @param string $groupSlug
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function getFriendsQueryBuilder()
    {
        $friendships = $this->findFriendships(FollowStatus::ACCEPTED)->get(['sender_id', 'receiver_id']);
        $recipients  = $friendships->pluck('receiver_id')->all();
        $senders     = $friendships->pluck('sender_id')->all();
        return $this->where('id', '!=', $this->getKey())->whereIn('id', array_merge($recipients, $senders));
    }
    
    /**
     * Get the query builder of the 'follow' Lawyer
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function getMutualFriendsQueryBuilder($other)
    {
        $user1['friendships'] = $this->findFriendships(FollowStatus::ACCEPTED)->get(['sender_id', 'receiver_id']);
        $user1['recipients'] = $user1['friendships']->pluck('receiver_id')->all();
        $user1['senders'] = $user1['friendships']->pluck('sender_id')->all();
        
        $user2['friendships'] = $other->findFriendships(FollowStatus::ACCEPTED)->get(['sender_id', 'receiver_id']);
        $user2['recipients'] = $user2['friendships']->pluck('receiver_id')->all();
        $user2['senders'] = $user2['friendships']->pluck('sender_id')->all();
        
        $mutualFriendships = array_unique(
                                    array_intersect(
                                        array_merge($user1['recipients'], $user1['senders']),
                                        array_merge($user2['recipients'], $user2['senders'])
                                    )
                                );
        return $this->whereNotIn('id', [$this->getKey(), $other->getKey()])->whereIn('id', $mutualFriendships);
    }

    /**
     * Get the query builder for friendsOfFriends ('follow' Lawyer)
     *
     * @param string $groupSlug
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function friendsOfFriendsQueryBuilder()
    {
        $friendships = $this->findFriendships(FollowStatus::ACCEPTED)->get(['sender_id', 'receiver_id']);
        $recipients = $friendships->pluck('receiver_id')->all();
        $senders = $friendships->pluck('sender_id')->all();
        $friendIds = array_unique(array_merge($recipients, $senders));
        $fofs = Follow::where('status', FollowStatus::ACCEPTED)
                            ->where(function ($query) use ($friendIds) {
                                $query->where(function ($q) use ($friendIds) {
                                    $q->whereIn('sender_id', $friendIds);
                                })->orWhere(function ($q) use ($friendIds) {
                                    $q->whereIn('receiver_id', $friendIds);
                                });
                            })
                            ->get(['sender_id', 'receiver_id']);
        $fofIds = array_unique(
            array_merge($fofs->pluck('sender_id')->all(), $fofs->pluck('receiver_id')->all())
        );
    //  Alternative way using collection helpers
    //  $fofIds = array_unique(
    //  $fofs->map(function ($item) { 
    //          return [$item->sender_id, $item->recipient_id];
    //      })->flatten()->all()
    //  );
        return $this->whereIn('id', $fofIds)->whereNotIn('id', $friendIds);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
   
    
    private function follows(){
        return $this->morphMany(Follow::class, 'sender');
    }

    
    protected function getOrPaginate($builder, $perPage)
    {
        if ($perPage == 0) {
            return $builder->get();
        }
        return $builder->paginate($perPage);
    }
}
