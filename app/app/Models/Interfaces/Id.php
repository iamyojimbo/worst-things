<?php

namespace App\Models\Interfaces;

abstract class Id
{
	protected $id;

	/**
	 * @param string $id;
	 */

	public function __construct($id) {
		if(!$id) throw new \Exception("$id cannot be falsy");
		$this->id = $id;
		// \Log::info("Id of type '" . get_class($this) . "' called '{$id}' created");
	}

	public function __toString() {
		return $this->id;
	}
}
