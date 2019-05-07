<?php

namespace App\Controllers;

use Core\Controller;

use App\Middlewares\userMiddleware as uMiddleware;

use Core\Traits\Redirect;

class homeController extends Controller
{
	use Redirect;

	private $uMiddleware;

	public function __construct()
	{	
		$this->uMiddleware = new uMiddleware;
		
		$this->redirectIfNotAuthenticated();

		parent::__construct();
	}

	public function show()
	{
		echo $this->view->render('home');
	}
}