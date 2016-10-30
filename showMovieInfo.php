<!DOCTYPE html>
<html>
<?php 
include_once "header.php";
$movieID = $_GET["id"];

if ($movieID=="") {exit(1);}

include_once "config/database.php";
include_once "entities/actors.php";
include_once "entities/movies.php";
include_once "entities/moviedirector.php";
include_once "entities/moviegenre.php";
include_once "entities/directors.php";
include_once "entities/reviews.php";

$DBconn = new DBConn();
$db = $DBconn->getDbConn();
//echo "Created Db conn successfully<br/>";

$actors = new Actor($db);
$movies = new Movie($db);
$moviedirector = new MovieDirector($db);
$movieGenre = new MovieGenre($db);
$directors = new Director($db);
$reviews = new Review($db);

$movieRes = $movies->getMovieInfo($movieID);
$actorRes = $actors->getActorsForMovie($movieID);
$genre = $movieGenre->getMovieGenre($movieID);
$review = $reviews->getReview($movieID);

if (($movieRes->num_rows)>0) {
    echo "<h3>Movie Information: </h3>";
    $iter=1;
    $movieRow = $movieRes->fetch_assoc();
    $directorID = $moviedirector->getDirectorID($movieRow["id"]);
    while ($dirRow = $directorID->fetch_assoc()) {
        //print ("\n".$dirRow["did"]. "\n");
        $directorName = $directors->getDirectorInfo($dirRow["did"]);
        $temp = $directorName->fetch_assoc();
        //print ($test["fullName"]);
        $dirName .= $temp["fullName"];
        $dirName .= " " ;
    }
    if ($dirName=="") {$dirName="No Director Info Present!";}
    
    //$dirName = $directorName->fetch_assoc();
    while ($genreRow = $genre->fetch_assoc()) {
        $allGenre.=$genreRow["genre"];
        $allGenre.=" ";
    }
    $avgReview = $reviews->getAvgRating($movieID);
    $avgReviewRow = $avgReview->fetch_assoc();
    $avgRating = $avgReviewRow["AvgRating"];
    if ($avgRating=="") {
        $avgRating = "No ratings given yet";    
    }
    ?>
    <table class='table table-bordered table-striped'>

        <tr>
            <td><b>MovieName</b></td><td><?php echo "".$movieRow["MovieName"].""; ?></td>
        </tr>
        <tr>
            <td><b>ReleasedOn</b></td><td><?php echo "".$movieRow["ReleasedOn"].""; ?></td>
        </tr>
        <tr>
            <td><b>Rating</b></td><td><?php echo "".$movieRow["Rating"].""; ?></td>
        </tr>
        <tr>
            <td><b>Company</b></td><td><?php echo "".$movieRow["Company"].""; ?></td>
        </tr>
        <tr>
            <td><b>Director</b></td><td><?php echo "".$dirName.""; ?></td>
        </tr>
        <tr>
            <td><b>Genre</b></td><td><?php echo "".$allGenre.""; ?></td>
        </tr>
        <tr>
            <td><b>Average Rating</b></td><td><?php echo "".$avgRating.""; ?></td>
        </tr>
    </table>
    <?php
} else {
    echo "<h3>No movie records for this ID!</h3>";
}

if (($actorRes->num_rows)>0) {
    echo "<h3>Actors in this movie: </h3><br/>";
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
    echo "<h3>No Actor Records present for this movie</h3>";
}

echo "<h3>User Reviews: </h3><br/>";
if (($review->num_rows)>0) {
    $iter=1;
    echo "<table class='jumbotron table table-striped'>";
    while ($revRow = $review->fetch_assoc()) {
        if ($iter==1) {
            echo "<tr>";
            foreach($revRow as $cname => $cvalue){
                echo "<th>".$cname."</th>";
            }
            echo "</tr>";
        }
        $id = $revRow["id"];
        echo "<tr>";
        foreach($revRow as $cname => $cvalue){
            echo "<td><a href='showActorInfo.php?id=".$id."'>".$cvalue."</a></td>";
        }
        echo "</tr>";
        $iter++;
    }
    echo "</table>";
} else {
    echo "No reviews given yet. Why don't you give one?<br/>";
}

echo "<h4><a href='addReview.php?movieID=$movieID'>Add new review for this movie: </a></h4><br/>";

$actorRes->free();
$movieRes->free();
//$movieActorRes->free();
$DBconn->closeDBConn();

?>
</div>
</body>
</html>