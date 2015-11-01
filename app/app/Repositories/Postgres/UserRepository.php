<?php

namespace App\Repositories\Postgres;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\Interfaces\Id;
use App\Models\User\UserId;
use App\Models\User\User;
use App\Models\User\Email;
use App\Models\User\FullName;
use Ramsey\Uuid\Uuid;
use App\Exceptions\ResourceNotFoundException;

class UserRepository extends UserRepositoryInterface
{
    public function getById(Id $id) {
        return new User(
            new UserId("auser"),
            new FullName("Savvas", "Nicholas"),
            new Email("iamyojimbo@gmail.com")
        );
    }

    public function getByFacebookId(Id $id) {
        throw new ResourceNotFoundException();
        return new User(
            new UserId("auser"),
            new FullName("FBSavvas", "Nicholas"),
            new Email("iamyojimbo@gmail.com")
        );
    }

    public function getByEmail(Email $email) {
        throw new ResourceNotFoundException();
        return new User(
            new UserId("auser"),
            new FullName("FBSavvas", "Nicholas"),
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

    public function save(User $user) {
        return $user;
    }
}
