<?php

namespace App\src\controller;

use App\src\model\View;
use App\src\DAO\MoviesDAO;

class FrontController
{
	private $view;
	private $moviesDAO;

	public function __construct()
	{
		$this->view = new View();
		$this->moviesDAO = new MoviesDAO();
	}

    public function home()
    {

        $films = $this->moviesDAO->getFilm();
        $heroCorps = $this->moviesDAO->getHeroCorp();
        $docs = $this->moviesDAO->getDoc();
        $simpsons = $this->moviesDAO->getSimpson();
        
        $this->view->render('home', [
            'films' => $films,
            'heroCorps' => $heroCorps,
            'docs' => $docs,
            'simpsons' => $simpsons
         
        ]);
    }

    public function single($id)
    {

    	$target = $id;

    	$this->view->render('single', ['target' => $target]);
    }
}