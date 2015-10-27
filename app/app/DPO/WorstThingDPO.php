<?php

namespace App\DPO;

use App\Repositories\Postgres\UserRepository;
use App\Repositories\Postgres\WorstThingRepository;
use App\Models\WorstThing\WorstThing;
use Log;

class WorstThingDPO
{
    protected $worstThing;
    protected $userRepo;
    protected $data;

    public function __construct(WorstThing $worstThing, UserRepository $userRepo) {
    	$this->worstThing = $worstThing;
    	$this->userRepo = $userRepo;
    	$this->resolveDependencies();
    }

    protected function resolveDependencies() {
    	$user = $this->userRepo->getById($this->worstThing->poster());
    	$this->data = $this->worstThing->toArray();
    	$this->data["poster"] = $user->toArray();
    }

    public function data() {
        return $this->data;
    }
}    