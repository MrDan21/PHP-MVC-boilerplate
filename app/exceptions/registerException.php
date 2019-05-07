<?php

namespace App\Exceptions;

use Core\Validator;

use PDO;

class registerException extends Validator
{

	public function setExceptions(array $attributes = [])
	{
		$this->exceptions = [
			[ 
				'condition' => empty($attributes[0]) OR empty($attributes[1]) OR empty($attributes[2]),
				'message' => 'No empty fields' 
			],
			[
				'condition' => $attributes[2] != $attributes[3],
				'message' => 'Passwords do not match'
			],
			[
				'condition' => !filter_var($attributes[1], FILTER_VALIDATE_EMAIL),
				'message' => 'Wrong email format'
			],
			[
				'condition' => $this->verifyEmail($attributes),
				'message' => 'Existing email'
			],
			[
				'condition' => !$attributes[4],
				'message' => 'You must accept terms and conditions'
			]
		];

		return $this;
	}

	private function verifyEmail(array $attributes = [])
	{
		$stmt = $this->conn->prepare("SELECT * FROM users WHERE email=:email LIMIT 1");
		$stmt->bindParam(':email', $attributes[1], PDO::PARAM_STR);
		$stmt->execute();

		return $stmt->rowCount() > 0;
	}
}