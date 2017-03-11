<?php
//Created by Srirag Nair
//User.class.php

require_once 'DB.class.php';


class User {

	public $id;
	public $username;
	public $password;
	public $firstname;
	public $lastname;

	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		$this->id = (isset($data['id'])) ? $data['id'] : "";
		$this->username = (isset($data['username'])) ? $data['username'] : "";
		$this->password = (isset($data['password'])) ? $data['password'] : "";
		$this->firstname = (isset($data['firstname'])) ? $data['firstname'] : "";
		$this->lastname = (isset($data['lastName'])) ? $data['lastname'] : "";
	}

	public function save($isNewUser = false) {
		//create a new database object.
		$db = new DB();
		
		//if the user is already registered and we're
		//just updating their info.
		if(!$isNewUser) {
			//set the data array
			$data = array(
				"username" => "'$this->username'",
				"password" => "'$this->password'",
				"firstname" => "'$this->firstname'",
                "lastname" => "'$this->lastname'"
			);
			
			//update the row in the database
			$db->update($data, 'sc_users', 'id = '.$this->id);
		}else {
		//if the user is being registered for the first time.
			$data =array(
				"username" => "'$this->username'",
				"password" => "'$this->password'",
				"firstname" => "'$this->firstname'",
                "lastname" => "'$this->lastname'"
			);
			
			$this->id = $db->insert($data, 'sc_users');
		}
		return true;
	}
	
}

?>