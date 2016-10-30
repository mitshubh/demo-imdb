<?php
class MovieDirector {
	private $conn;
	private $table_name = "MovieDirector";

	public $mid;
	public $aid;
	
	public function __construct($db) {
		$this->conn = $db;
	}

	public function addMovieDirectorRelation($movieID, $directorID) {
		$query = "INSERT INTO " .$this->table_name. " VALUES('" .$movieID. "', '" .$directorID. "')";
		return $this->conn->query($query);
	}

	public function getDirectorID($movieID) {
		//echo "".$movieID."";
		$query = "SELECT did FROM " .$this->table_name. " WHERE mid = " .$movieID. "";
		//echo "query: " .$query. "";
		return $this->conn->query($query);	 
	}
}
?>