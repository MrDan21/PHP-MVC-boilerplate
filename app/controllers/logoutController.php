<?php

namespace App\Controllers;

use Core\Controller;

use Core\Session;

use Core\Helpers as Helper;

use App\Middlewares\userMiddleware as uMiddleware;

use Core\Traits\Redirect;

class logoutController extends Controller
{

	use Redirect;

	public function __construct()
	{	
		$this->uMiddleware = new uMiddleware;
		
		$this->redirectIfNotAuthenticated();
		
		parent::__construct();
	}

	public function logout()
	{
		Session::remove('user');

		Session::remove('confirmed');

		Helper::redirect();
	}
}