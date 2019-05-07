<?php

namespace Core;

use Core\Session;

class Alert
{
	private static $alerts = ['danger', 'success'];

	private static $html;

	public static function __callStatic(string $method, array $attributes = [])
	{
		if(! in_array(strtolower($method), self::$alerts)) {
			throw new \Exception('Alert not defined');
		}

		$message = isset($attributes[0]) ? $attributes[0] : null;

		self::setAlertMessage(strtolower($method), $message);

		Session::set('Alert', self::getAlertMessage());
	}

	private static function setAlertMessage(string $alert, string $message)
	{
		self::$html = "<div class='alert alert-{$alert}' role='alert'>
  		{$message}</div>";
	}

	private static function getAlertMessage() : string
	{
		return (string) self::$html;
	}
}