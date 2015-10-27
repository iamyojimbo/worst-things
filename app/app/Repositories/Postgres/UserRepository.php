<?php

namespace App\Repositories\Postgres;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\Interfaces\Id;
use App\Models\User\UserId;
use App\Models\User\User;
use App\Models\User\Email;
use App\Models\User\FullName;
use Ramsey\Uuid\Uuid;

class UserRepository extends UserRepositoryInterface
{
    public function getById(Id $id) {
        return new User(
            $this->nextIdentity(),
            new FullName("Savvas", "Nicholas"),
            new Email("iamyojimbo@gmail.com")
        );
    }

    public function nextIdentity() {
        $smallUuid = substr(Uuid::uuid4(), 0, 8);
        return new UserId($smallUuid);
    }

    public function getAll() {
        return $this->getById(null);
    }
}
