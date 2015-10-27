<?php

use App\Models\Entity;

namespace App\Models\WorstThing;

class Downvote implements Entity
{
    protected $id; 
    protected $worstThingId; 
	protected $userId; 

    private function __construct(
    	DownvoteId $id,
        WorstThingId $worstThingId,
        UserId $userId
    ) 
    {
    	$this->id = $id;
        $this->worstThingId = $worstThingId;
        $this->userId = $userId;
    }

    /**
     * Construct a new instance that doesn't yet exist in the DB
     * 
     * @param WorstThingId $worstThingId
     * @param UserId $userId
     * 
     */
    public static function constructNew(
        WorstThingId $worstThingId,
        UserId $userId        
    ) 
    {
    	return new Downvote(
    		null,
    		$name,
    		$image,
    	);
    }

    public function id() {
        return $this->id;
    }

    public function worstThingId() {
        return $this->worstThingId;
    }

    public function userId() {
        return this->userId;
    }
}
