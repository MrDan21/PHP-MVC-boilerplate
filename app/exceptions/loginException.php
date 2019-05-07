<?php

namespace App\Exceptions;

use Core\Traits\Auth;

use Core\Validator;

class loginException extends Validator
{

	use Auth;

	public function setExceptions(array $attributes = [])
	{
		$this->exceptions = [
			[ 
				'condition' => empty($attributes[0]) OR empty($attributes[1]),
				'message' => 'No empty fields' 
			],
			[
				'condition' => !$this->authPassword($attributes[0], $attributes[1]),
				'message' => 'Incorrect credentials'
			]
		];
		
		return $this;
	}
}