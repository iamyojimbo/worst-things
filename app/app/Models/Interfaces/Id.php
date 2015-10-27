<?php

namespace App\Models\Interfaces;

abstract class Id
{
	protected $id;

	/**
	 * @param string $id;
	 */

	public function __construct($id) {
		$this->id = $id;
		\Log::info("Id of type '" . get_class($this) . "' called '{$id}' created");
	}

	public function __toString() {
		return $this->id;
	}
}
