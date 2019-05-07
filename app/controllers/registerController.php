<?php

namespace App\Controllers;

use App\Models\registerModel;

use Core\Controller;

use Core\Alert;

use Core\Helpers as Helper;

use App\Exceptions\registerException as registerEx;

use App\Middlewares\userMiddleware as uMiddleware;

use Core\Traits\Redirect;

class registerController extends Controller
{
	use Redirect;

	private $model;
	private $registerEx;
	private $uMiddleware;

	public function __construct()
	{	
		$this->model = new registerModel;
		$this->registerEx = new registerEx;
		$this->uMiddleware = new uMiddleware;

		parent::__construct();
	}

	public function show()
	{
		$this->redirectIfAuthenticated('user/home/');

		echo $this->view->render('users/register');
	}

	public function register()
	{
		$request = [ 
			$this->request->post('name'),
			$this->request->post('email'),
			$this->request->post('password'),
			$this->request->post('confirm_password'),
			isset($_POST['is_agree']) ? true : false,
		];

		if( !$this->registerEx->setExceptions($request)->validate() ){
			echo $this->view->render('users/register');
			exit;
		}

		$this->model->register($request);

		Helper::redirect('user/home/');
	}
}