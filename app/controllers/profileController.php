<?php

namespace App\Controllers;

use Core\Controller;

use App\Models\profileModel;

use Core\Session;

use Core\Alert;

use Core\Helpers as Helper;

use App\Middlewares\userMiddleware as uMiddleware;

use App\Exceptions\profileException as profileEx;

use Core\Traits\Redirect;

class profileController extends Controller
{
	use Redirect;

	private $model;
	private $profileEx;
	private $uMiddleware;

	public function __construct()
	{	
		$this->model = new profileModel;
		$this->profileEx = new profileEx;
		$this->uMiddleware = new uMiddleware;

		$this->redirectIfNotAuthenticated();

		$this->redirectIfNotConfirmed(['danger', 'You have not confirmed your email']);

		parent::__construct();
	}

	public function show()
	{
		$user = $this->model->find('users', Session::get('user')['id']);
		
		echo $this->view->render('users/profile', [
			'user' => $user,
		]);
	}

	public function update()
	{
		$request = [ 
			$this->request->post('name'),
			Session::get('user')['id'],
		];

		if( !$this->profileEx->setExceptions($request)->validate() ) {
			echo $this->view->render('users/profile', [
				'user' => Session::get('user'),
			]);
			exit;
		}

		$this->model->update($request);

		Alert::Success("Your name was updated!");

		Helper::redirect('user/home/');
	}

	public function delete()
	{
		$this->model->delete('users', Session::get('user')['id']);

		Helper::redirect('user/logout/');
	}
}