<?php

namespace App\Models;

use Core\Model;

use PDO;

class profileModel extends Model
{
	public function update(array $attributes = [])
	{
		$stmt = $this->conn->prepare("UPDATE users SET name=:name WHERE id=:id LIMIT 1");
		$stmt->bindParam(':name', $attributes[0], PDO::PARAM_STR);
		$stmt->bindParam(':id', $attributes[1], PDO::PARAM_INT);
		$stmt->execute();
	}
}