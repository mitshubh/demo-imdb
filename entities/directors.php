<?php
class Actor {
	private $conn;
	private $table_name = "Director";

	public $id;
	public $last;
	public $first;
	public $dob;
	public $dod;

	public funtion __construct($db) {
		$this->conn = $db;
	}
}
?>