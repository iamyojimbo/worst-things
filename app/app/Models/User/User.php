<?php

namespace App\Models\User;

use App\Models\User\UserId;

class User extends \App\Models\Interfaces\Aggregate
{
    protected $fullName;
    protected $email;

     /**
     * @param UserId $id
     * @param FullName $fullName
     * @param Email $email
     */
    public function __construct(
    	UserId $id, 
    	FullName $fullName,
        Email $email
    ) 
    {
        parent::__construct();
    	$this->id = $id;
    	$this->fullName = $fullName;
        $this->email = $email;
    }

    public function toArray() {
        return [
            "id" => $this->id,
            "fullName" => $this->fullName,
            "email" => $this->email
        ];
    }
}
