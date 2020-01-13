<?php

namespace App\config;

use App\src\controller\FrontController;
use App\src\controller\UserController;
use App\src\controller\ErrorController;

class Router
{

	private $frontController;
    private $userController;
    private $errorController;


	public function __construct()
	{
		$this->frontController = new FrontController();
        $this->userController = new UserController();
        $this->errorController = new ErrorController();
	}

	public function run()
	{
        try{
            if(isset($_GET['route']))
            {
            	if($_GET['route'] === 'movie' && $this->isUserAdmin() === true){
                    $this->frontController->single($_GET['idArt']);
                }

                else if($_GET['route'] === 'signIn'){
                    $this->userController->signIn($_POST);
                }

                else if($_GET['route'] === 'logIn' ){
                    $this->userController->logIn($_POST);
                }

                else if($_GET['route'] === 'logOut'){
                    $this->userController->logOut();
                }

                else{
                	$this->errorController->error404();
                }
            }
            else{
            	$this->frontController->home();
            }
        }
        catch (\Exeption $e)
        {
        	$this->errorController->error404();
        }
		
		
	}
    private function isUserAdmin()
    {
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin')
        {
            return true;
        }
        else
        {
            $this->errorController->error403();
        }
    }

}