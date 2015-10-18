<?php

namespace App\Models;

class WorstThing
{
	protected $id;
    protected $name;
    protected $image;
    protected $poster;
    protected $comments;
    protected $votes;
    protected $createDatetime;

    private function __construct(
    	$id, 
    	$name, 
    	Image $image, 
    	WorstThingPoster $poster,
    	\DateTime $createDatetime
    ) 
    {
    	$this->id = $id;
    	$this->name = $name;
    	$this->image = $image;
    	$this->poster = $poster;
    	$this->createDatetime = $createDatetime;
    }

    /**
     * Construct a new instance that doesn't yet exist in the DB
     * 
     * @param string $name
     * @param Image $image
     * @param WorstThingPoster $poster
     * @param DateTime $createDatetime
     * 
     */
    public static function constructNew($name, Image $image, WorstThingPoster $poster) {
    	return new WorstThing(
    		null,
    		$name,
    		$image,
    		$poster,
    		new \DateTime()
    	);
    }

    public function getName() {
    	return $this->name;
    }

    public function getImage() {
    	return $this->image;
    }

    public function getPoster() {
    	return $this->poster;
    }

    public function getCreatedDatetime() {
    	return $this->createDatetime;
    }
}
