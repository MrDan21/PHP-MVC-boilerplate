<?php

namespace Core;

class Helpers
{
	public static function redirect(string $to = '')
	{
		header('location:'.BASE_URL.$to);
	}
}