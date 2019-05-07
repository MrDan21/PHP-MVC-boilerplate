<?php

namespace Core;

class Request
{
	public function get(string $name)
	{
		return $_GET[$name] ?? null;
	}

	public function post(string $name)
	{
		return $_POST[$name] ?? null;
	}
}