<?php
class Director {
	private $conn;
	private $table_name = "Director";

	public $id;
	public $last;
	public $first;
	public $dob;
	public $dod;

	public function __construct($db) {
		$this->conn = $db;
	}

	public function getDirectorList() {
		$query = "SELECT id, CONCAT(first, ' ', last) As fullName FROM " . $this->table_name . "";
		return $this->conn->query($query);
	}

	public function getDirectorInfo($directorID) {
		$query = "SELECT id, CONCAT(first, ' ', last) As fullName FROM " . $this->table_name . " WHERE id = " .$directorID. "";
		//print ("\n" .$query. "\n");
		return $this->conn->query($query);
	}

	public function addDirectorInfo($fname, $lname, $dob, $dod) {
		$this->first = $fname;
		$this->last = $lname;
		$this->dob = $dob;
		$this->dod = !empty($dod) ? "'$dod'" : "NULL";
		$maxIdQuery = "SELECT id FROM MaxPersonID";
		$maxPersonID = $this->conn->query($maxIdQuery);
		$tempID = $maxPersonID->fetch_assoc();
		$this->id = $tempID["id"]+1;
		$query = "INSERT INTO " .$this->table_name. " VALUES( '" .$this->id. "', '" .$this->last. "', '" .$this->first. "', '" .$this->dob. "', " .$this->dod. ")";
		//echo "Query: " .$query. "<br/>";
		$maxIdQuery = "UPDATE MaxPersonID SET id = " .$this->id. "";
		$this->conn->query($maxIdQuery);
		return $this->conn->query($query);
	}
}
?>