<?php

namespace App\Models;

use Core\Model;

use Core\Session;

use Core\Traits\Auth;

use PDO;

class loginModel extends Model
{

	use Auth;

	public function login(array $attributes = [])
	{
		Session::set('user', $this->auth($attributes[0], ['id', 'name', 'email'])->fetch());
		
		if(!$this->has_confirmation($attributes[0])) {
			Session::set('confirmed', 0);
		}

		$this->remember_me($attributes[2]);
	}

	public function findKeyConfirmationUserId(string $key_confirmation)
	{
		$stmt = $this->conn->prepare("SELECT * FROM users WHERE key_confirmation=:key_confirmation LIMIT 1");
		$stmt->bindParam(':key_confirmation', $key_confirmation, PDO::PARAM_STR);
		$stmt->execute();
		
		return $stmt->fetch()['id'];	
	}

	public function confirmation(int $id)
	{
		$stmt = $this->conn->prepare("UPDATE users SET confirmation=true WHERE id=:id LIMIT 1");
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();

		Session::remove('confirmed');
	}

	private function has_confirmation(string $email) : bool
	{
		$confirmation = 1;

		$stmt = $this->conn->prepare("SELECT * FROM users WHERE email=:email AND confirmation=:confirmation LIMIT 1");
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':confirmation', $confirmation, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->rowCount() > 0 ? true : false;
	}

	private function remember_me(bool $remember_me)
	{
		if($remember_me) {
			ini_set('session.cookie_lifetime', 1800 );
		}
	}
}