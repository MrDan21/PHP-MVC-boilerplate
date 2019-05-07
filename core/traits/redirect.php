<?php

namespace Core\Traits;

use Core\Alert;

trait Redirect 
{
	private function redirectIfAuthenticated(string $to, array $alert = [])
	{
		if($this->uMiddleware->redirectIfAuthenticated()) {
			
			$this->setAlert($alert);

			$this->redirect($to);
		}
	}

	private function redirectIfNotAuthenticated(array $alert = [])
	{
		if(!$this->uMiddleware->redirectIfAuthenticated()) {
			
			$this->setAlert($alert);

			$this->redirect('user/login/');
		}
	}

	private function redirectIfNotConfirmed(array $alert = [])
	{
		if($this->uMiddleware->redirectIfNotConfirmed()) {
			
			$this->setAlert($alert);

			$this->redirect('user/home/');
		}	
	}

	private function redirect(string $to)
	{
		header('location:'.BASE_URL.$to);
		exit;
	}

	private function setAlert(array $alert)
	{
		if( count($alert) != 0 ) {

			$type = isset($alert[0]) ? $alert[0] : null;
			
			$message = isset($alert[1]) ? $alert[1] : null;
			
			Alert::$type($message);
		}
	}
}