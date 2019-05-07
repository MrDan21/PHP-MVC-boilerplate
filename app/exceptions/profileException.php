<?php

namespace App\Exceptions;

use Core\Validator;

class profileException extends Validator
{

	public function setExceptions(array $attributes = [])
	{
		$this->exceptions = [
			[ 
				'condition' => empty($attributes[0]),
				'message' => 'No empty fields' 
			],
		];
		
		return $this;
	}
}