<!DOCTYPE html>
<html>
<?php 
include_once "header.php";
include_once "config/database.php";
include_once "entities/movies.php";
include_once "entities/actors.php";
include_once "entities/movieactor.php";

$DBconn = new DBConn();
$db = $DBconn->getDbConn();
//echo "Created Db conn successfully<br/>";

$actors = new Actor($db);
$movies = new Movie($db);
$movieActor = new MovieActor($db);
?>

<h3 style="margin-top:50px">Add New Movie - Actor Relation:</h3>
<form method="GET" action="addMovieActorRelation.php">
    <div class="form-group">
        <label for="movieID">Select Movie:</label>
        <?php
            print '<select name="movieID" class="form-control" placeholder= "Select Movie Title ... " required>';
            $movieList = $movies->getMovieList();
            print '<option value="NoVal"</option>';
            foreach ( $movieList as $movieRow ) {
                print '<option value="'.$movieRow["id"].'"'.($movieRow === $currently_selected ? ' selected="selected"' : '').'>'.$movieRow["title"].'</option>';
            }
            print '</select>';
        ?>
    </div>
    <div class="form-group">
        <label for="actorID">Select Actor:</label>
        <?php
            print '<select name="actorID" class="form-control" placeholder= "Select Actor ... " required>';
            $actorList = $actors->getActorList();
            //echo "Reached!!<br/>";
            print '<option value="NoVal"</option>';
            foreach ( $actorList as $actorRow ) {
                print '<option value="'.$actorRow["id"].'"'.($actorRow === $currently_selected ? ' selected="selected"' : '').'>'.$actorRow["fullName"].'</option>';
            }
            print '</select>';
        ?>
    </div>
    <div class="form-group">
        <label for="role">Actor Role:</label>
        <input type="text" class="form-control" name="role" placeholder= "Enter Actor Role ... " required>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>

<?php

$movieID = $_GET["movieID"];
$actorID = $_GET["actorID"];
$role = $_GET["role"];

if ($movieID=="") {exit(1);}

if ($movieID=="NoVal") {echo "<b><br/>Error: Select a Movie </b><br/>";exit(1);}
if ($actorID=="NoVal") {echo "<b><br/>Error: Select an Actor </b><br/>";exit(1);}
$movieActorRes = $movieActor->addMovieActorRelation($movieID, $actorID, $role);
if ($movieActorRes) {
    echo "<b><br/>Success!! Movie-Actor relation added successfully</b><br/>";
} else {
    echo "<b><br/>Error:</b> ". $db->error. "<br/>";
}
$DBconn->closeDBConn();
?>
</div>
</body>
</html>