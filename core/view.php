<?php

namespace Core;

class View
{
	public function render($template, array $args = [])
	{
		if(!empty($args)) {
			extract($args);
		} 

		ob_start();
		
		include('views/'.$template.'.php');
		
		return ob_get_clean();
	}
}