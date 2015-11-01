<?php

namespace App\Models\WorstThing;

use App\Models\User\UserId;

class WorstThing extends \App\Models\Interfaces\Aggregate
{
    protected $name;
    protected $image;
    protected $poster;
    protected $downvotes;

     /**
     * Construct a new instance that doesn't yet exist in the DB
     * 
     * @param WorstThingId $id
     * @param string $name
     * @param Image $image
     * @param UserId $poster
     * @param DateTime $createDateTime
     * 
     */
    public function __construct(
        $id,
    	$name, 
    	Image $image, 
    	UserId $poster,
        $downvotes
    ) 
    {
        parent::__construct();
    	$this->id = $id;
    	$this->name = $name;
    	$this->image = $image;
    	$this->poster = $poster;
        $this->downvotes = $downvotes;
    }

    public function downvote() {
        $this->downvotes++;
    }

    public function id() {
        return $this->id;
    }

    public function name() {
    	return $this->name;
    }

    public function image() {
    	return $this->image;
    }

    public function poster() {
    	return $this->poster;
    }

    public function downvotes() {
        return $this->downvotes;
    }

    public function toArray() {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "image" => $this->image,
            "poster" => $this->poster,
            "downvotes" => $this->downvotes,
            "createdDateTime" => $this->createdDateTime,
        ];
    }
}
