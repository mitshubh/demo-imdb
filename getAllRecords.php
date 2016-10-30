<!DOCTYPE html>
<html>
<?php 
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
include_once "header.php";

$inputStr = $_GET["query"];
if ($inputStr=="") {exit(1);}
	
include_once "config/database.php";
include_once "entities/actors.php";
include_once "entities/movies.php";
//echo "Files included successfully<br/>";

$DBconn = new DBConn();
$db = $DBconn->getDbConn();
//echo "Created Db conn successfully<br/>";

$actors = new Actor($db);
$movies = new Movie($db);
//echo "" .$inputStr. " Is the input";

$actorRes = $actors->readActors($inputStr);
$movieRes = $movies->readMovies($inputStr);

if (($actorRes->num_rows)>0) {
	echo "<h3>Actor Records :: </h3>";
	$iter=1;
	echo "<table class='jumbotron table table-striped'>";
	while ($row = $actorRes->fetch_assoc()) {
		if ($iter==1) {
			echo "<tr>";
			foreach($row as $cname => $cvalue){
				//if ($cname=="id") {continue;}
				echo "<th>".$cname."</th>";
			}
			echo "</tr>";
		}
		$id = $row["id"];
		echo "<tr>";
        foreach($row as $cname => $cvalue){
        	//if ($cname=="id") {continue;}
        	echo "<td><a href='showActorInfo.php?id=".$id."'>".$cvalue."</a></td>";
    	}
    	echo "</tr>";
        $iter++;
    }
    echo "</table>";
} else {
	echo "<h3>No Actor Records present</h3>";
}

if (($movieRes->num_rows)>0) {
	echo "<h3>Movie Records :: </h3>";
	$iter=1;
	echo "<table class='jumbotron table table-striped'>";
	while ($row = $movieRes->fetch_assoc()) {
		if ($iter==1) {
			echo "<tr>";
			foreach($row as $cname => $cvalue){
				echo "<th>".$cname."</th>";
			}
			echo "</tr>";
		}
		$id = $row["id"];
		echo "<tr>";
        foreach($row as $cname => $cvalue){
        	echo "<td><a href='showMovieInfo.php?id=".$id."'>".$cvalue."</a></td>";
    	}
    	echo "</tr>";
        $iter++;
    }
    echo "</table>";
} else {
	echo "<h3>No Movie Records present</h3>";
}
$actorRes->free();
$movieRes->free();
$DBconn->closeDBConn();
?>
</div>
</body>
</html>