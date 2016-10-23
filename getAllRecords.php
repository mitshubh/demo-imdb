<?php /*ini_set('display_errors', 'On'); error_reporting(E_ALL);
echo '<pre>'; var_dump("Entered Here"); echo '</pre>';
public function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}*/
//echo "Entered getAllRecords";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once "config/database.php";
include_once "entities/actors.php";
include_once "entities/movies.php";

$DBconn = new DBConn();
$db = $DBconn->getDbConn();
//echo "Created Db conn successfully<br/>";

$actors = new Actor($db);
$movies = new Movie($db);

$inputStr = $_GET["query"];
//echo "" .$inputStr. " Is the input";

$actorRes = $actors->readActors($inputStr);
$movieRes = $movies->readMovies($inputStr);

$actorArr = array();
$movieArr = array();

if (($actorRes->num_rows)>0) {
	while ($row = $actorRes->fetch_assoc()) {
		$actorArr[] = $row;
    }
}

if (($movieRes->num_rows)>0) {
	while ($row = $movieRes->fetch_assoc()) {
		$movieArr[] = $row;
    }
}

echo '{"movieRecords":[' .json_encode($movieArr). '],';
echo '"actorRecords":[' .json_encode($actorArr). ']}';

//$db->closeDBConn();
?>