<?php

namespace Core;

use Core\Database\Connection;

use Core\View;

abstract class Model extends Connection 
{
	public function findOrError(string $table, int $id, View $view, $columns = '*') : array
	{
		$model = parent::find($table, $id, $columns);
		
		$this->renderIfFalse($model);

		return $model;
	}

	public function errorIfNotFound(string $table, int $id, View $view, $columns = '*')
	{
		$this->renderIfFalse(parent::find($table, $id, $columns), $view);
	}	

	final private function renderIfFalse($model, View $view)
	{
		if(!$model) {
			echo $view->render('errors/404');
			exit;
		}
	}	
}