<?php

namespace Core\Database;

use PDO;

abstract class Connection
{
	protected $conn;

	public function __construct()
	{
		try {
			$this->conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			echo "Connection failed: " . $e->getMessage();
		}
	}

	public function getAll(string $table, $order = null) : array
	{
		$sql = "SELECT * FROM $table";

		if($order != NULL) {
			$sql.= " ORDER BY $order ASC";
		}

		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	protected function getLastId(string $table)
	{
		$stmt = $this->conn->prepare("SELECT MAX(id) FROM $table");
		$stmt->execute();
		return $stmt->fetchColumn(0);
	}

	public function find(string $table, int $id, $columns = '*')
	{
		if(is_array($columns)) {
			$columns = implode(',', $columns);
		}

		$stmt = $this->conn->prepare("SELECT $columns FROM $table WHERE id=:id LIMIT 1");
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();

		if($stmt->rowCount() > 0) {
			return $stmt->fetch();	
		}

		return 0;
	}

	public function delete(string $table, int $id)
	{
		$stmt = $this->conn->prepare("DELETE FROM $table WHERE id=:id LIMIT 1");
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
	}
}