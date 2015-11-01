<?php

namespace App\Events;

use App\Events\Event;
use App\Models\WorstThing\WorstThingId;
use App\Models\Downvote\DownvoteId;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class WorstThingWasDownvoted extends Event
{
    use SerializesModels;

    private $worstThingId;
    private $downvoteId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        WorstThingId $worstThingId,
        DownvoteId $downvoteId
    ) {
        $this->worstThingId = $worstThingId;
        $this->downvoteId = $downvoteId;    
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }

    public function worstThingId() {
        return $this->worstThingId;
    }

    public function downvoteId() {
        return $this->downvoteId;
    }
}
