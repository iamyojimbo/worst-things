<?php

namespace App\Models\User;

class Email
{
    protected $email;

     /**
     * @param string $email
     */

    public function __construct(
    	$email
    ) 
    {
    	$this->email = $email;
        $this->validate();
    }

    public function validate() {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("'{$this->email}' is not a valid email address");
        }
    }

    public function __toString() {
        return $this->email;
    }
}
