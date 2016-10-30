<!DOCTYPE html>
<html>
<?php 
include_once "header.php";
?>

<h3 style="margin-top:50px">Add New Movie:</h3>
<form method="GET" action="addMovie.php">
    <div class="form-group">
        <label for="title">Movie Name:</label>
        <input type="text" name="title" class="form-control" placeholder= "Enter Movie Title ... " required>
    </div>
    <div class="form-group">
        <label for="rating">Movie Rating:</label>
        <select class="form-control" name="rating">
            <option value="PG">PG</option>
            <option value="PG-13">PG-13</option>
            <option value="R">R</option>
            <option value="NC-17">NC-17</option>
            <option value="surrendere">surrendere</option>
            <option value="G">G</option>
        </select>
    </div>
    <div class="form-group">
        <label for="company">Company:</label>
        <input type="text" class="form-control" name="company" placeholder= "Enter Movie Company ... " required>
    </div>
    <div class="form-group">
        <label for="year">Release Year:</label>
        <?php
            $curr_selec = date('Y');
            $earliest_year = 1750;
            $latest_year = date('Y');
            print '<select name="year" class="form-control">';
            foreach ( range( $latest_year, $earliest_year ) as $i ) {
              print '<option value="'.$i.'"'.($i === $currently_selected ? ' selected="selected"' : '').'>'.$i.'</option>';
            }
            print '</select>';
        ?>
    </div>
    <div class="form-group">
        <label for="genre">Movie Genre:</label>
        <select class="form-control selectpicker" multiple name="genre[]">
            <option value="Drama">Drama</option>
            <option value="Comedy">Comedy</option>
            <option value="Romance">Romance</option>
            <option value="Crime">Crime</option>
            <option value="Horror">Horror</option>
            <option value="Mystery">Mystery</option>
            <option value="Thriller">Thriller</option>
            <option value="Action">Action</option>
            <option value="Adventure">Adventure</option>
            <option value="Fantasy">Fantasy</option>
            <option value="Documentary">Documentary</option>
            <option value="Family">Family</option>
            <option value="Sci-Fi">Sci-Fi</option>
            <option value="Animation">Animation</option>
            <option value="War">War</option>
            <option value="Western">Western</option>
            <option value="Adult">Adult</option>
            <option value="Short">Short</option>
        </select>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>

<?php

include_once "config/database.php";
include_once "entities/movies.php";
include_once "entities/moviegenre.php";

$title = $_GET["title"];
$rating = $_GET["rating"];
$company = $_GET["company"];
$year = $_GET["year"];
$genreArr = $_GET["genre"];

if ($title=="") {exit(1);}
$DBconn = new DBConn();
$db = $DBconn->getDbConn();
//echo "Created Db conn successfully<br/>";

$movies = new Movie($db);
$movieGenre = new MovieGenre($db);
$movieID = $movies->addMovieInfo($title, $year, $rating, $company);
$movieGenre->addMovieGenre($movieID, $genreArr);

$DBconn->closeDBConn();
?>
</div>
</body>
</html>