<?php

namespace Core\Traits;

use PDO;

trait Auth 
{
	private function auth(string $email, $columns = '*')
	{
		$email = strtolower($email);
		
		if(is_array($columns)) {
			$columns = implode(',', $columns);
		}

		$stmt = $this->conn->prepare("SELECT $columns FROM users WHERE email=:email LIMIT 1");
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();

		return $stmt;
	}

	private function authPassword(string $email, string $password)
	{
		$hash = $this->auth($email)->fetch()['password'];
		return password_verify($password, $hash);
	}
}