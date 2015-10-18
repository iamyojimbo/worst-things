<?php

namespace App\Models;

class WorstThingPoster
{
	protected $id;
    protected $name;

    private function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * Construct a new instance that doesn't yet exist in the DB
     * 
     * @param string $name
     * 
     */
    public static function constructNew($name) {
        return new WorstThingPoster(null, $name);
    }

    public function getName() {
        return $this->name;
    }
}
