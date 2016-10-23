<?php

class DBConn {
	private $host = 'localhost';
	private $username = 'cs143';
	private $database = 'CS143';
	private $password = '';
	public $db = null;

	public function getDbConn() {
		$this->db = new mysqli($this->host, $this->username, $this->password, $this->database);
		//$db = new mysqli('localhost', 'cs143', '', 'CS143');
		if ($this->db -> connect_errno >0) {
			die('Unable to connect to database [' . $this->db->connect_error . ']');
		}
		return $this->db;
	}

	public function closeDBConn() {
		//($this->db)->close;
	}

	/*public function select($query) {
		if (!($rs = $db->query($query))) {
			$errMsg = $db->error;
			print "Incorrect Query : $errMsg <br/>" ;
		}
		return $rs;
	}

	public function insert($query) {
		if (!mysqli_query($con,$query)) {
			echo("Error description: " . mysqli_error($con));
			return false;
		}
		return true;
	}

	public function update($query) {
		if (!mysqli_query($con,$query)) {
			echo("Error description: " . mysqli_error($con));
			return false;
		}
		return true;
	}

	public function delete($query) {	
		if (!mysqli_query($con,$query)) {
			echo("Error description: " . mysqli_error($con));
			return false;
		}
		return true;	
	}*/
}

?>