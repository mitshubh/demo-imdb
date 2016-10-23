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
	public function readMovies($inputStr) {
		$query = "SELECT * FROM " . $this->table_name . " WHERE title like " .$inputStr. "";
		return $this->conn->query($query);
	}
}
?>