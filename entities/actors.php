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
}
?>