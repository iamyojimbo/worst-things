<?php

namespace App\Models\WorstThing;

class Image
{
    protected $uri;


    /**
     * 
     * @param string $uri
     * 
     */
    public function __construct($uri) {
        $this->uri = $uri;
    }

    public function uri() {
        return $this->uri;
    }
}
