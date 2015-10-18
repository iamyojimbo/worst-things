<?php

namespace App\Models;

class Image
{
    protected $uri;

    private function __construct($uri) {
        $this->uri = $uri;
    }

    /**
     * Construct a new instance that doesn't yet exist in the DB
     * 
     * @param string $uri
     * 
     */
    public static function constructNew($uri) {
        return new Image($uri);
    }

    public function getUri() {
        return $this->uri;
    }
}
