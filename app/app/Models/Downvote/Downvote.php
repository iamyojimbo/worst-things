<?php

namespace App\Models\Downvote;

use App\Models\Interfaces\Aggregate;
use App\Models\User\UserId;
use App\Models\WorstThing\WorstThingId;
use App\Models\Downvote\DownvoteId;

class Downvote extends Aggregate
{
    protected $userId; 

    public function __construct(
        DownvoteId $id,
        WorstThingId $worstThingId,
        UserId $userId
    ) 
    {
        $this->id = $id;
        $this->worstThingId = $worstThingId;
        $this->userId = $userId;
    }

    public function userId() {
        return $this->userId;
    }

    public function worstThingId() {
        return $this->worstThingId;
    }

    public function toArrayRecursive() {
        return [
            "id" => (string) $this->id,
            "worstThingId" => (string) $this->worstThingId,
            "userId" => (string) $this->userId,
        ];
    }
}
