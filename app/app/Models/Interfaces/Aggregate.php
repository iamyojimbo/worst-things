<?php

namespace App\Models\Interfaces;

abstract class Aggregate
{
	protected $id;
	protected $createdDateTime;

	public function __construct() {
		$this->createdDateTime = new \DateTime();
	}

	public function id() {
		return $this->id;
	}

	public function createdDateTime() {
		return $this->createdDateTime;
	}

}
