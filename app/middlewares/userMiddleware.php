<?php

namespace App\Middlewares;

use Core\Session;

class userMiddleware
{
	public function redirectIfAuthenticated()
	{
		return Session::exists('user');
	}

	public function redirectIfNotConfirmed()
	{
		return Session::exists('confirmed');
	}
}