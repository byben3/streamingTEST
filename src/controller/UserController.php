<?php

namespace App\src\controller;

use App\src\model\View;
use App\src\DAO\UserDAO;
use App\src\model\User;

class UserController

{
	private $view;
	private $userDAO;
	private $user;

    public function __construct()
    {
        $this->view = new View();
        $this->userDAO = new UserDAO();
        $this->user = new User();
       

    }


    public function signIn($post)
    {
    	if(isset($post['submit'])){
    		$User = new User();
    		$User->newUser($post);                 
    	}
    	$this->view->render('home', ['post' => $_POST]);
    }

    public function logIn($post)
    {
    	if(isset($post['submit'])){
    		$User = new User();
    		$User->connectUser($post);
    	}
    	$this->view->render('home', ['post' => $_POST]);        
    }

    public function logOut()
    {
        $User = new User();
        $User->disconnectUser();
    }



}