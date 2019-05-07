<?php

namespace Core;

use Core\Alert;

use Core\Database\Connection;

use Exception;

abstract class Validator extends Connection
{

	protected $exceptions = [];

	public function validate() : bool
	{
		try { 
			foreach($this->exceptions AS $exception) {
				$this->exceptionCondition($exception['condition'], $exception['message']);
			}
		} catch(Exception $e) {
			Alert::Danger($e->getMessage());
			return false;
		}

		return true;
	}

	final private function exceptionCondition($contidition, string $message) 
	{
		if($contidition) {
			throw new Exception($message);
		}
	}

	abstract public function setExceptions(array $attributes = []);
}