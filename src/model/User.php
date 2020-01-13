<?php

namespace App\src\model;

use App\src\DAO\UserDAO;
use App\src\model\User;


class User
{

    private $ID;

    private $name;

    private $password;

    private $role;


    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @param mixed $ID
     */
    public function setID($ID)
    {
        $this->ID = $ID;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    } 

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

        /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    public function __construct()
    {

        $this->userDAO = new UserDAO();
    }


    public function existingUser()
    {
          
        $user = $this->userDAO->getUserByName($_POST['name']); 
        if($user !== false && $user instanceof User)
        {
            return true;
        }
        else
        {
            return false;
        }    
    }

    public function connectUser()
    {

        if(!empty($_POST['name']) || !empty($_POST['password']))
        {

            $user = $this->userDAO->getUserByName($_POST['name']); 
           if($user !== false && $user instanceof User)
           {

              if(password_verify($_POST['password'], $user->getPassword())=== true)
              {
                $_SESSION['name'] = $_POST['name'];
                $_SESSION['ID'] = $user->getID();


                if($user->getRole() === 'admin'){
                    $_SESSION['role'] = "admin";
                    header('Location: ../public/index.php');
                
                }
                else
                {
                    $_SESSION['role'] = "user";
                    header('Location: ../public/index.php'); 
                }

              }
              else
              {
                echo '<script>alert("nom ou mot de passe incorrect")</script>';
              }  
           }
           else
           {
                echo '<script>alert("nom ou mot de passe incorrect")</script>';
           }
        }
        else
        {
            echo '<script>alert("veuillez renseignez les champs obligatoire ( * )")</script>';
        }
    }

    public function disconnectUser()
    {
            session_unset();
            session_destroy();
            header('Location: ../public/index.php');
    }


    public function newUser($data)
    {

        if($_POST['password'] == $_POST['confirmPassword'])
        {
            if(!empty($_POST['name']) && !empty($_POST['password']))
            {
                $user = new User();
                $verify = $user->existingUser($data);
        

                if(!$verify)
                {
                                            
                        $_POST['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
                        
                        $this->userDAO->addUser($_POST);

                        $userId = $this->userDAO->getUserByName($_POST['name']);

                        $_SESSION['name'] = $_POST['name'];
                        $_SESSION['ID'] = $userId->getID();
                        $_SESSION['role'] = "user";
                        
                        header('Location: ../public/index.php');             
                      
                }
                else
                {
                    echo '<script>alert("pseudo invalide ou existe deja")</script>';
                }
            }    
            else
            {
                echo '<script>alert("veuillez renseignez les champs obligatoire ( * )")</script>';
            }
        }
        else
        {
            echo '<script>alert("le mot de passe confirmer est different du mot de passe.")</script>';
        }
    }


    public function newPassword()
    {

      $user = $this->userDAO->getUserByName($_POST['name']);
        
        if(password_verify($_POST['password'], $user->getPassword())=== true)
        {
            if($_POST['newPassword'] == $_POST['confirmNewPassword'])
            {
                $_POST['newPassword'] = password_hash($_POST['newPassword'], PASSWORD_BCRYPT);

                $this->userDAO->updatePassword($_POST);
                $_SESSION['changePasswordSucces'] = 'Le mot de passe a ete modifie';
                header('Location: ../public/index.php?route=myProfil&name=' . $_POST['name']);  

            }
            else
            {
                echo '<script>alert("le nouveau mot de passe confirmer est different du nouveau mot de passe.")</script>';
            }
        }
        else
        {
            echo '<script>alert("le mot de passe est invalide")</script>';
        }
    }

}