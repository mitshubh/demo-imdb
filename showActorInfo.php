<!DOCTYPE html>
<html>
<?php 
include_once "header.php";
$actorID = $_GET["id"];

if ($actorID=="") {exit(1);}
    
include_once "config/database.php";
include_once "entities/actors.php";
include_once "entities/movies.php";
//include_once "entities/movieactor.php";

$DBconn = new DBConn();
$db = $DBconn->getDbConn();
//echo "Created Db conn successfully<br/>";

$actors = new Actor($db);
$movies = new Movie($db);
//$movieactor = new Movie($db);

$actorRes = $actors->getActorInfo($actorID);
//$movieActorRes = $movieactor->getMovieIdForActor($actorID);
$movieRes = $movies->getMoviesForActor($actorID);

if (($actorRes->num_rows)>0) {
    echo "<h3>Actor Info:</h3><br/>";
    $iter=1;
    echo "<table class='jumbotron table table-striped'>";
    while ($row = $actorRes->fetch_assoc()) {
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
    echo "<h3>Acted in the following movies: </h3>";
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
    echo "<h3>Actor hasn't acted in any movies yet!</h3>";
}


$actorRes->free();
$movieRes->free();
//$movieActorRes->free();
$DBconn->closeDBConn();

?>
</div>
</body>
</html>