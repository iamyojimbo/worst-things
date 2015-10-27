<?php

namespace App\Models\User;

class FullName
{
    protected $firstName;
    protected $lastName;

     /**
     * @param string $firstName
     * @param string $lastName
     */

    public function __construct(
    	$firstName,
        $lastName
    ) 
    {
    	$this->firstName = $firstName;
    	$this->lastName = $lastName;
    }

    public function fullName() {
        return $this->firstName . " " . $this->lastName;
    }

    public function firstName() {
        return $this->firstName();
    }

    public function lastName() {
        return $this->lastName();
    }

    public function __toString() {
        return $this->fullName();
    }
}
