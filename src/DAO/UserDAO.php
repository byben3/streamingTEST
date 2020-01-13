<?php

namespace App\src\DAO;

use App\src\model\User;

class UserDAO extends DAO
{


	public function getUsers()
	{
		$sql = 'SELECT * FROM user ORDER BY ID';
		$result = $this->sql($sql);
		$users = [];
		foreach ($result as $row) {
			$userId = $row['ID'];
			$users[$userId] = $this->buildObject($row);
		}
		return $users;
	}

	public function getUserByName($name)
	{
		$sql = "SELECT * FROM user WHERE name = '$name'";
		$result = $this->sql($sql);
		$data = $result->fetch();

		if($data !== false)
		{
			return $user = $this->buildObject($data);
		}
		
        
		return $result->fetch();
	}

	public function addUser($userInfo)
	{
		extract($userInfo);
		$name = htmlspecialchars($_POST['name']);
	    $sql = 'INSERT INTO user (name ,password ,role) VALUES (? ,? ,"admin")';
		$this->sql($sql, [$name ,$password]);
	}

	public function updatePassword($data)
	{
		
		$password = $_POST['newPassword'];
		$id = $_POST['user_id'];
		$sql = "UPDATE user SET password='$password' WHERE ID = '$id'";
		$this->sql($sql);
	
	}

    private function buildObject(array $row)
    {
        $user = new User();
        $user->setID($row['ID']);
        $user->setName($row['name']);
       	$user->setPassword($row['password']);
       	$user->setRole($row['role']);

        return $user;
    }

}
