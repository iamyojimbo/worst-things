<?php

namespace App\Repositories\Postgres;

use App\Repositories\Interfaces\WorstThingRepositoryInterface;
use App\Models\WorstThing;
use App\Models\Image;
use App\Models\WorstThingPoster;

class WorstThingRepository extends WorstThingRepositoryInterface
{
	public $counter = 0;

    public function getById($id) {
		$this->counter++;
    	return new WorstThing();
    }

    public function getAll() {
    	return [
    		WorstThing::constructNew(
    			"hello",
    			Image::constructNew("http://www.supercomfort.in/admin/upload/mattress-protector.jpg"),
    			WorstThingPoster::constructNew("Jeff")
    		),
    		WorstThing::constructNew(
    			"This!",
    			Image::constructNew("https://pbs.twimg.com/profile_images/415917193814372352/HiEKWGSW.jpeg"),
    			WorstThingPoster::constructNew("John")
    		),
    		WorstThing::constructNew(
    			"Bad Stuff",
    			Image::constructNew("http://4.bp.blogspot.com/_ZixWZixxNfI/TAizE1_WFsI/AAAAAAAAA7E/6svc-FgO2iM/s1600/SP040665.JPG"),
    			WorstThingPoster::constructNew("Savvas")
    		),
    		WorstThing::constructNew(
    			"hello",
    			Image::constructNew("http://www.supercomfort.in/admin/upload/mattress-protector.jpg"),
    			WorstThingPoster::constructNew("Jeff")
    		),
    		WorstThing::constructNew(
    			"This!",
    			Image::constructNew("https://pbs.twimg.com/profile_images/415917193814372352/HiEKWGSW.jpeg"),
    			WorstThingPoster::constructNew("John")
    		),
    		WorstThing::constructNew(
    			"Bad Stuff",
    			Image::constructNew("http://4.bp.blogspot.com/_ZixWZixxNfI/TAizE1_WFsI/AAAAAAAAA7E/6svc-FgO2iM/s1600/SP040665.JPG"),
    			WorstThingPoster::constructNew("Savvas")
    		),
    		WorstThing::constructNew(
    			"hello",
    			Image::constructNew("http://www.supercomfort.in/admin/upload/mattress-protector.jpg"),
    			WorstThingPoster::constructNew("Jeff")
    		),
    		WorstThing::constructNew(
    			"This!",
    			Image::constructNew("https://pbs.twimg.com/profile_images/415917193814372352/HiEKWGSW.jpeg"),
    			WorstThingPoster::constructNew("John")
    		),
    		WorstThing::constructNew(
    			"Bad Stuff",
    			Image::constructNew("http://4.bp.blogspot.com/_ZixWZixxNfI/TAizE1_WFsI/AAAAAAAAA7E/6svc-FgO2iM/s1600/SP040665.JPG"),
    			WorstThingPoster::constructNew("Savvas")
    		),
    	];
    }


}
