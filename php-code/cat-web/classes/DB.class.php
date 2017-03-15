<?php
//Created by Srirag Nair
//DB.class.php
error_reporting(E_ERROR);
require_once 'config/config.php';
class DB {
	protected $db_name = 'sails-catdb';
	protected $db_user = 'sails_db';
	protected $db_pass = 'Sails1119';
	protected $db_host = 'localhost';
	// open a connection to the database. Make sure this is called
	// on every page that needs to use the database.
	public function connect() {
		//$conn = @mysqli_connect($this->db_host, $this->db_user, $this->db_pass);
		static $con;
		if (!$con) {
			$con = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
		}
		return $con;
	}

	//takes a mysql row set and returns an associative array, where the keys
	//in the array are the column names in the row set. If singleRow is set to
	//true, then it will return a single row instead of an array of rows.
	public function processRowSet($rowSet, $singleRow=false)
	{
		$resultArray = array();
		while($row = mysqli_fetch_assoc($rowSet))
		{
			array_push($resultArray, $row);
		}

		if($singleRow === true)
			return $resultArray[0];

		return $resultArray;
	}

	//Select rows from the database.
	//returns a full row or rows from $table using $where as the where clause.
	//return value is an associative array with column names as keys.
	public function select($table, $where) {
		$sql = "SELECT * FROM $table WHERE $where";
		$result = mysqli_query($this->connect(),$sql);
		if($result->num_rows === 1)
			return $this->processRowSet($result, true);

		return $this->processRowSet($result);
	}

	//Updates a current row in the database.
	//takes an array of data, where the keys in the array are the column names
	//and the values are the data that will be inserted into those columns.
	//$table is the name of the table and $where is the sql where clause.
	public function update($data, $table, $where) {
		foreach ($data as $column => $value) {
			$sql = "UPDATE $table SET $column = $value WHERE $where";
			mysqli_query($this->connect(),$sql) or die(mysqli_error());
		}
		return true;
	}

	//Inserts a new row into the database.
	//takes an array of data, where the keys in the array are the column names
	//and the values are the data that will be inserted into those columns.
	//$table is the name of the table.
	public function insert($data, $table) {

		$columns = "";
		$values = "";

		foreach ($data as $column => $value) {
			$columns .= ($columns == "") ? "" : ", ";
			$columns .= $column;
			$values .= ($values == "") ? "" : ", ";
			$values .= $value;
		}

		$sql = "insert into $table ($columns) values ($values)";

		mysqli_query($this->connect(),$sql) or die(mysqli_error());

		//return the ID of the user in the database.
		return mysqli_insert_id($this->connect());

	}

}

?>