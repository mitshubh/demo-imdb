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
		$this->db->close();
	}
}

?>