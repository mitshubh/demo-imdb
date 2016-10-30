<?php
class Review {
	private $conn;
	private $table_name = "Review";

	public $name;
	public $time;
	public $mid;
	public $rating;
	public $comment;

	public function __construct($db) {
		$this->conn = $db;
	}

	public function addReview($name, $time, $mid, $rating, $comment) {
		$timeStampQuery = "SELECT NOW() AS currTime";
		$timeStampRes = $this->conn->query($timeStampQuery);
		$timeStamp = $timeStampRes->fetch_assoc();
		$time = $timeStamp["currTime"];
		$query = "INSERT INTO " .$this->table_name. " VALUES('" .$name. "', '" .$time. "', '" .$mid. "', '" .$rating. "', '" .$comment. "')";
		//print ($query);
		return $this->conn->query($query);
	}

	public function getReview($mid) {
		$query = "SELECT * FROM " .$this->table_name. " WHERE mid = " .$mid. "";
		//print ($query);
		return $this->conn->query($query);	
	}

	public function getAvgRating($mid) {
		$query = "SELECT AVG(rating) AS AvgRating FROM " .$this->table_name. " WHERE mid = " .$mid. "";
		//print ($query);
		return $this->conn->query($query);	
	}
}
?>