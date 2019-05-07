<?php

namespace App\Controllers;

use App\Models\loginModel;

use Core\Controller;

use Core\Alert;

use Core\Helpers as Helper;

use App\Exceptions\loginException as loginEx;

use App\Middlewares\userMiddleware as uMiddleware;

use Core\Session;

use Core\Traits\Redirect;

class loginController extends Controller
{

	use Redirect;

	private $model;
	private $loginEx;
	private $uMiddleware;

	public function __construct()
	{	
		$this->model = new loginModel;
		$this->loginEx = new loginEx;
		$this->uMiddleware = new uMiddleware;
		parent::__construct();
	}

	public function show()
	{
		$this->redirectIfAuthenticated('user/home/');
		
		echo $this->view->render('users/login');
	}

	public function login()
	{
		$request = [ 
			$this->request->post('email'),
			$this->request->post('password'),
			isset($_POST['remember_me']) ? true : false,
		];

		if( !$this->loginEx->setExceptions($request)->validate() ) {
			echo $this->view->render('users/login');
			exit;
		}

		$this->model->login($request);

		Helper::redirect('user/home/');
	}

	public function confirmation()
	{

		$this->redirectIfNotAuthenticated(['danger', 'You are not logged in!']);

		$id = $this->model->findKeyConfirmationUserId($this->request->get('key'));

		$this->model->errorIfNotFound('users', $id, $this->view);

		$this->model->confirmation($id);

		Alert::Success("Your account was confirmed!");

		Helper::redirect('user/login/');
	}
}