<?php

namespace App\DPO;

use App\Repositories\Postgres\UserRepository;
use App\Repositories\Postgres\WorstThingRepository;
use App\Models\WorstThing\WorstThing;
use Log;

class WorstThingDPO extends DPO
{
    protected $userRepo;

    public function __construct(WorstThing $worstThing, UserRepository $userRepo) {
    	$this->userRepo = $userRepo;
    	$this->data = $this->resolveDependencies($worstThing);
    }

    protected function resolveDependencies(WorstThing $worstThing) {
    	$user = $this->userRepo->getById($worstThing->poster());
    	$data = $worstThing->toArray();
    	$data["poster"] = $user->toArray();
        return $data;
    }
}    