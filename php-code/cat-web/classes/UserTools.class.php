<?php
//Created by Srirag Nair
//UserTools.class.php

require_once 'User.class.php';
require_once 'DB.class.php';
class UserTools {

	//Log the user in. First checks to see if the 
	//username and password match a row in the database.
	//If it is successful, set the session variables
	//and store the user object within.
	
	public function login($username, $password)
	{
		$db = new DB();
		$conn = $db->connect();
		$result = mysqli_query($conn, "SELECT * FROM `sc_users` WHERE username = '" . $username . "' AND password = '" . $password ."'");
		if($result){
			if($result->num_rows === 0)
			{
				return false;
			}else{
				$_SESSION["user"] = serialize(new User(mysqli_fetch_assoc($result)));
				$_SESSION["login_time"] = time();
				$_SESSION["logged_in"] = 1;
				return true;
			}
		} else {
			return false;
		}
		
	}
	
	//Log the user out. Destroy the session variables.
	public function logout() {
		unset($_SESSION['user']);
		unset($_SESSION['login_time']);
		unset($_SESSION['logged_in']);
		session_destroy();
	}

	//Check to see if a username exists.
	//This is called during registration to make sure all user names are unique.
	public function checkUsernameExists($username) {
		$db = new DB();
		$conn = $db->connect();
		$result = mysqli_query($conn,"select id from sc_users where username='" . $username . "'");
    	if($result){
			if($result->num_rows === 0)
			{
				return false;
			}else{
				return true;
			}
		} else {
			return false;
		}
	}
	
	//get a user
	//returns a User object. Takes the users id as an input
	public function get($id)
	{
		$db = new DB();
		$result = $db->select('sc_users', "id = $id");
		
		return new User($result);
	}
	
}

?>