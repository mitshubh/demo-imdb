<?php
class MovieActor {
	private $conn;
	private $table_name = "MovieActor";

	public $mid;
	public $aid;
	public $role;
	
	public function __construct($db) {
		$this->conn = $db;
	}

	public function getMovieIdForActor($actorID) {
		$query = "SELECT MA.mid, MA.role FROM " . $this->table_name . " MA WHERE MA.aid = " .$actorID. "";
		return $this->conn->query($query);
	}

	public function addMovieActorRelation($movieID, $actorID, $role) {
		$query = "INSERT INTO " .$this->table_name. " VALUES('" .$movieID. "', '" .$actorID. "', '" .$role. "')";
		return $this->conn->query($query);	
	}
}
?>