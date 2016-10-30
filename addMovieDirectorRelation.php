<!DOCTYPE html>
<html>
<?php 
include_once "header.php";
include_once "config/database.php";
include_once "entities/movies.php";
include_once "entities/directors.php";
include_once "entities/moviedirector.php";

$DBconn = new DBConn();
$db = $DBconn->getDbConn();
//echo "Created Db conn successfully<br/>";

$directors = new Director($db);
$movies = new Movie($db);
$movieDirector = new MovieDirector($db);
?>

<h3 style="margin-top:50px">Add New Movie - Director Relation:</h3>
<form method="GET" action="addMovieDirectorRelation.php">
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
        <label for="directorID">Select Director:</label>
        <?php
            print '<select name="directorID" class="form-control" placeholder= "Select Director ... " required>';
            $directorList = $directors->getDirectorList();
            //echo "Reached!!<br/>";
            print '<option value="NoVal"</option>';
            foreach ( $directorList as $directorRow ) {
                print '<option value="'.$directorRow["id"].'"'.($directorRow === $currently_selected ? ' selected="selected"' : '').'>'.$directorRow["fullName"].'</option>';
            }
            print '</select>';
        ?>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>

<?php

$movieID = $_GET["movieID"];
$directorID = $_GET["directorID"];
if ($movieID=="") {exit(1);}

if ($movieID=="NoVal") {echo "<b><br/>Error: Select a Movie </b><br/>";exit(1);}
if ($directorID=="NoVal") {echo "<b><br/>Error: Select a Director </b><br/>";exit(1);}

$movieDirectorRes = $movieDirector->addMovieDirectorRelation($movieID, $directorID);
if ($movieDirectorRes) {
    echo "<b><br/>Success!! Movie-Director relation added successfully</b><br/>";
} else {
    echo "<b><br/>Error:</b> ". $db->error. "<br/>";
}
$DBconn->closeDBConn();
?>
</div>
</body>
</html>