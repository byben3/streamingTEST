<?php

namespace App\src\controller;

use App\src\model\View;

class ErrorController
{

	private $view;

	public function __construct()
	{
		$this->view = new View();
	}

	public function error403()
	{
		$this->view->render('error403');
	}
	
	public function error404()
	{
		$this->view->render('error404');
	}


}