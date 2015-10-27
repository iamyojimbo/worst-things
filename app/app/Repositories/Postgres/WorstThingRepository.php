<?php

namespace App\Repositories\Postgres;

use App\Repositories\Interfaces\WorstThingRepositoryInterface;
use App\Models\Interfaces\Id;

use App\Models\WorstThing\WorstThing;
use App\Models\WorstThing\Image;
use App\Models\WorstThing\WorstThingId;

use App\Models\User\UserId;
use Ramsey\Uuid\Uuid;

class WorstThingRepository extends WorstThingRepositoryInterface
{
    public function getById(Id $id) {
    	return new WorstThing();
    }

    public function nextIdentity() {
        $smallUuid = substr(Uuid::uuid4(), 0, 8);
        return new WorstThingId($smallUuid);
    }

    public function getAll() {
    	return [
    		new WorstThing(
                $this->nextIdentity(),
    			"This!",
    			new Image("http://www.supercomfort.in/admin/upload/mattress-protector.jpg"),
    			new UserId("Jeff"),
                12
    		),
    		new WorstThing(
                $this->nextIdentity(),
    			"This guy!",
    			new Image("https://pbs.twimg.com/profile_images/415917193814372352/HiEKWGSW.jpeg"),
    			new UserId("Jeff"),
                12
    		),
    		new WorstThing(
                $this->nextIdentity(),
    			"This!",
    			new Image("http://4.bp.blogspot.com/_ZixWZixxNfI/TAizE1_WFsI/AAAAAAAAA7E/6svc-FgO2iM/s1600/SP040665.JPG"),
    			new UserId("Jeff"),
                12
    		),
    		new WorstThing(
                $this->nextIdentity(),
    			"This!",
    			new Image("http://www.supercomfort.in/admin/upload/mattress-protector.jpg"),
    			new UserId("Jeff"),
                12
    		),
    		new WorstThing(
                $this->nextIdentity(),
    			"This guy!",
    			new Image("https://pbs.twimg.com/profile_images/415917193814372352/HiEKWGSW.jpeg"),
    			new UserId("Jeff"),
                12
    		),
    		new WorstThing(
                $this->nextIdentity(),
    			"This!",
    			new Image("http://4.bp.blogspot.com/_ZixWZixxNfI/TAizE1_WFsI/AAAAAAAAA7E/6svc-FgO2iM/s1600/SP040665.JPG"),
    			new UserId("Jeff"),
                12
    		),
    		new WorstThing(
                $this->nextIdentity(),
    			"This!",
    			new Image("http://www.supercomfort.in/admin/upload/mattress-protector.jpg"),
    			new UserId("Jeff"),
                12
    		),
    		new WorstThing(
                $this->nextIdentity(),
    			"This guy!",
    			new Image("https://pbs.twimg.com/profile_images/415917193814372352/HiEKWGSW.jpeg"),
    			new UserId("Jeff"),
                12
    		),
    		new WorstThing(
                $this->nextIdentity(),
    			"This!",
    			new Image("http://4.bp.blogspot.com/_ZixWZixxNfI/TAizE1_WFsI/AAAAAAAAA7E/6svc-FgO2iM/s1600/SP040665.JPG"),
    			new UserId("Jeff"),
                12
    		),
    	];
    }


}
