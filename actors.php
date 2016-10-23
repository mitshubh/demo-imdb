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
		$parts = preg_split("/\s+/", subject);
		$length = count($parts);
		if ($length==1) {
			$query = "SELECT * FROM " . $this->table_name . " WHERE first like " .$parts[0]. " OR last like " .$parts[0]."";
		} else {
			$query = "SELECT * FROM " . $this->table_name . " WHERE (first like " .$parts[0]. " AND last like " .$parts[1].") OR (first like " .$parts[1]. " AND last like " .$parts[0].")";
		}
		return $this->conn->query($query);
	}
}
?>