<?php
class Actor {
	private $conn;
	private $table_name = "Actor";

	public $id;
	public $last;
	public $first;
	public $sex;
	public $dob;
	public $dod;

	public function __construct($db) {
		$this->conn = $db;
	}

	public function getActorList() {
		$query = "SELECT id, CONCAT(first, ' ', last) As fullName FROM " . $this->table_name . "";
		return $this->conn->query($query);
	}

	public function readActors($inputStr) {
		//echo "Reading Actors...";
		$parts = preg_split("/\s+/", $inputStr);
		$length = count($parts);
		//print_r($parts);
		if ($length==1) {
			$query = "SELECT id, CONCAT(first, ' ', last) As ActorName, sex AS Gender, dob AS Birthdate, dod AS Deathdate FROM " . $this->table_name . " WHERE first like '%" .$parts[0]. "%' OR last like '%" .$parts[0]."%'";
		} else {
			$query = "SELECT id, CONCAT(first, ' ', last) As ActorName, sex AS Gender, dob AS Birthdate, dod AS Deathdate FROM " . $this->table_name . " WHERE (first like '%" .$parts[0]. "%' AND last like '%" .$parts[1]."%') OR (first like '%" .$parts[1]. "%' AND last like '%" .$parts[0]."%')";
		}

		//echo "".$query."";
	    $result = $this->conn->query($query);
	    //echo "Result == ".$result->num_rows."";
	    return $result;
	}

	public function getActorInfo($id) {
		$query = "SELECT id, CONCAT(first, ' ', last) AS Name, sex AS Gender, dob as BirthDate, dod AS DeathDate FROM " .$this->table_name. " WHERE " .$this->table_name. ".id = " .$id. ""; 
		//print ($query."\n");
		return $this->conn->query($query);
	}

	public function getActorsForMovie($movieID) {
		$query = "SELECT A.id, CONCAT(A.first, ' ', A.last) AS Name, A.sex AS Gender, MA.role AS Role FROM " .$this->table_name. " A, MovieActor MA WHERE MA.aid = A.id AND MA.mid = " .$movieID. "";
		return $this->conn->query($query);
	}

	public function addActorInfo($fname, $lname, $sex, $dob, $dod) {
		$this->first = $fname;
		$this->last = $lname;
		$this->sex = $sex;
		$this->dob = $dob;
		$this->dod = !empty($dod) ? "'$dod'" : "NULL";
		$maxIdQuery = "SELECT id FROM MaxPersonID";
		$maxPersonID = $this->conn->query($maxIdQuery);
		$tempID = $maxPersonID->fetch_assoc();
		$this->id = $tempID["id"]+1;
		$query = "INSERT INTO " .$this->table_name. " VALUES( '" .$this->id. "', '" .$this->last. "', '" .$this->first. "', '" .$this->sex. "', '" .$this->dob. "', " .$this->dod. ")";
		//echo "Query: " .$query. "<br/>";
		$maxIdQuery = "UPDATE MaxPersonID SET id = " .$this->id. "";
		$this->conn->query($maxIdQuery);
		return $this->conn->query($query);
	}
}
?>