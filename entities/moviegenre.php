<?php
class MovieGenre {
	private $conn;
	private $table_name = "MovieGenre";

	public $mid;
	public $genre;

	public function __construct($db) {
		$this->conn = $db;
	}

	public function addMovieGenre($id, $genreArr) {
		foreach ($genreArr as $genre) {
    		$genreQuery = "INSERT INTO " .$this->table_name. " VALUES('" .$id. "', '" .$genre. "')";
    		//echo "GenreQuery: " .$genreQuery. "<br/>";
    		$rs = $this->conn->query($genreQuery);
    		if (!$rs) {echo "Error: " .$this->conn->error. "<br/>";}
		}
	}

	public function getMovieGenre($id) {
		$query = "SELECT genre FROM " .$this->table_name. " WHERE mid = " .$id. "";
		//echo "" .$query. "";
		return $this->conn->query($query);
	}
}
?>