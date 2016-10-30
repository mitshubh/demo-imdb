<?php
class Movie {
	private $conn;
	private $table_name = "Movie";

	public $id;
	public $title;
	public $year;
	public $rating;
	public $company;

	public function __construct($db) {
		$this->conn = $db;
	}

	public function getMovieList() {
		//echo "Reading Movies:...";
		$query = "SELECT id, title FROM " . $this->table_name . "";
		return $this->conn->query($query);
	}

	public function readMovies($inputStr) {
		//echo "Reading Movies:...";
		$query = "SELECT id, title AS MovieName, year AS ReleasedOn, rating as Rating, company as Company FROM " . $this->table_name . " WHERE title like '%" .$inputStr. "%'";
		return $this->conn->query($query);
	}

	public function getMoviesForActor($actorID) {
		$query = "SELECT M.id, M.title AS MovieName, MA.role AS ActorRole FROM " .$this->table_name. " M, MovieActor MA WHERE MA.mid = M.id AND MA.aid = " .$actorID. "";
		return $this->conn->query($query);
	}

	public function getMovieInfo($movieID) {
		$query = "SELECT id, title AS MovieName, year AS ReleasedOn, rating as Rating, company as Company FROM " .$this->table_name. " WHERE id = " .$movieID. "";
		return $this->conn->query($query);
	}

	public function addMovieInfo($title, $year, $rating, $company) {
		$maxIdQuery = "SELECT id FROM MaxMovieID";
		$maxMovieID = $this->conn->query($maxIdQuery);
		$tempID = $maxMovieID->fetch_assoc();
		$id = $tempID["id"]+1;
		$query = "INSERT INTO " .$this->table_name. " VALUES('" .$id. "', '" .$title. "', '" .$year. "', '" .$rating. "', '" .$company. "')";
		$maxIdQuery = "UPDATE MaxMovieID SET id = " .$id. "";
		$this->conn->query($maxIdQuery);
		//echo "Movie Query: " .$query. "<br/>";
		$movieRes = $this->conn->query($query);
		if ($movieRes) {
		    echo "<b><br/>Success!! New Movie added successfully</b><br/>";
		} else {
		    echo "<b><br/>Error:</b> ". $db->error. "<br/>";
		}
		return $id;
	}
}
?>