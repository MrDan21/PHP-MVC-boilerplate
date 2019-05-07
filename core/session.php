<?php

namespace Core;

class Session
{
	public function start()
	{
		if(session_status() == PHP_SESSION_NONE) {
			session_start();
		}
	}

	public static function set($key, $value)
	{
		$_SESSION[$key] = $value;
	}

	public static function get($key)
	{
		if(self::exists($key)) {
			return $_SESSION[$key];
		}
	}

	public static function remove($key)
	{
		if(self::exists($key)) {
			unset($_SESSION[$key]);
		}
	}

	public static function exists($key)
	{
		return isset($_SESSION[$key]);
	}

	public static function expireSession()
	{
		if(self::exists('time')) {

			$maximunInactivityTime = 1200;

			$sessionLife = time() - self::get('tiempo');

			$sessionLife > $maximunInactivityTime ? session_destroy() : self::set('tiempo', time());
		
		}
	}
}