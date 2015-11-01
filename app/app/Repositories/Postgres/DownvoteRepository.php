<?php

namespace App\Repositories\Postgres;

use App\Repositories\Interfaces\DownvoteRepositoryInterface;
use App\Models\Interfaces\Id;
use App\Models\Downvote\Downvote;
use App\Models\Downvote\DownvoteId;
use App\Models\User\UserId;
use App\Models\WorstThing\WorstThingId;
use App\Exceptions\ResourceNotFoundException;
use Ramsey\Uuid\Uuid;

class DownvoteRepository extends DownvoteRepositoryInterface
{
    public function getById(Id $id) {
        return new Downvote(
            $this->nextIdentity(),
            new WorstThingId("aworstthing"),
            new UserId("auser")
        );
    }

    public function nextIdentity() {
        $smallUuid = substr(Uuid::uuid4(), 0, 8);
        return new DownvoteId($smallUuid);
    }

    public function getAll() {
        return [$this->getById(null)];
    }

    public function getByUserIdAndWorstThingId(
        UserId $userId, 
        WorstThingId $WorstThingId
    ) {
        throw new ResourceNotFoundException();
        return new Downvote(
            $this->nextIdentity(),
            new WorstThingId("aworstthing"),
            new UserId("auser")
        );
    }

    public function getByUserId(UserId $userId) {
        return [
            new Downvote(
                $this->nextIdentity(),
                new WorstThingId("hello1"),
                new UserId("auser")
            ),
            new Downvote(
                $this->nextIdentity(),
                new WorstThingId("hello2"),
                new UserId("auser")
            ),
            new Downvote(
                $this->nextIdentity(),
                new WorstThingId("hello3"),
                new UserId("auser")
            ),
        ];
    }

    public function save(Downvote $downvote) {
        return $downvote;
    }
}
