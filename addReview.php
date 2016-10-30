<!DOCTYPE html>
<html>
<?php 
include_once "header.php";

include_once "config/database.php";
include_once "entities/movies.php";
include_once "entities/reviews.php";

$DBconn = new DBConn();
$db = $DBconn->getDbConn();
//echo "Created Db conn successfully<br/>";

$movies = new Movie($db);
$reviews = new Review($db);
$movieID = $_GET["movieID"];
?>
<h3 style="margin-top:50px">Add New Review :</h3>
<form method="GET" action="addReview.php">
	<div class="form-group">
		<label for="uName">Name:</label>
		<input type="text" class="form-control" name="uName" placeholder= "Enter Your Name ... " required>
	</div>
    <div class="form-group">
        <label for="movieID">Select Movie:</label>
        <?php
            print '<select name="movieID" class="form-control" placeholder= "Select Movie Title ... " required>';
            $movieList = $movies->getMovieList();
            print '<option value="NoVal"</option>';
            foreach ( $movieList as $movieRow ) {
                print '<option value="'.$movieRow["id"].'"'.($movieID === $movieRow["id"] ? ' selected="selected"' : '').'>'.$movieRow["title"].'</option>';
            }
            print '</select>';
        ?>
    </div>
    <div class="form-group">
        <label for="rating">Rating:</label>
        <select name="rating" class="form-control selectpicker">
			<option>1</option>
			<option>2</option>
			<option>3</option>
			<option>4</option>
			<option>5</option>
		</select>
    </div>

    <div class="form-group">
		<label for="comment">Comment:</label>
		<textarea class="form-control" rows="5" name="comment"></textarea>
	</div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
<?php

$uName = $_GET["uName"];
$rating = $_GET["rating"];
$comment = $_GET["comment"];
if ($rating=="" || $uName=="") {exit(1);}
if ($movieID=="NoVal") {echo "<b><br/>Error: Select a Movie </b><br/>";exit(1);}
//echo "Movie";
$review = $reviews->addReview($uName, "", $movieID, $rating, $comment);
if ($review) {
    echo "<b><br/>Success!! Review added successfully</b><br/>";
} else {
    echo "<b><br/>Error:</b> ". $db->error. "<br/>";
}
$DBconn->closeDBConn();
?>
</div>
</body>
</html>