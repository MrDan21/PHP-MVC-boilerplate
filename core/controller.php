<?php

namespace Core;

use Core\View;

use Core\Request;

abstract class Controller
{
	protected $view;
	protected $request;

	protected function __construct()
	{
		$this->view = new View;
		$this->request = new Request;
	}
}