<?php

namespace App\Listeners;

use App\Events\WorstThingWasDownvoted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Repositories\Postgres\WorstThingRepository;
use App\Repositories\Postgres\UserRepository;
use App\Repositories\Postgres\DownvoteRepository;
use Log;

class DownvoteWorstThing
{
    private $worstThingRepo;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(WorstThingRepository $worstThingRepo)
    {
        $this->worstThingRepo = $worstThingRepo;
    }

    /**
     * Handle the event.
     *
     * @param  WorstThingWasDownvoted  $event
     * @return void
     */
    public function handle(WorstThingWasDownvoted $event)
    {
        Log::info("Event 'WorstThingWasDownvoted' fired with WorstThingId '{$event->worstThingId()}' and DownvoteId '{$event->downvoteId()}'");
        $worstThing = $this->worstThingRepo->getById($event->worstThingId());
        $worstThing->downvote();
        $this->worstThingRepo->save($worstThing);
    }
}
