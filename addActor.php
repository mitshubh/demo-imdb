<!DOCTYPE html>
<html>
<?php 
include_once "header.php";
?>

<h3 style="margin-top:50px">Add New Actor/Director:</h3>
<form method="GET" action="addActor.php">
    <div class="form-group">
        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" class="form-control" placeholder= "Enter First Name ... " required>
    </div>
    <div class="form-group">
        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" class="form-control" placeholder= "Enter Last Name ... " required>
    </div>
    <div class="radio">
        <label class="radio-inline"><input type="radio" name="post" value="actor" checked> Actor</label>
        <label class="radio-inline"><input type="radio" name="post" value="director" > Director</label>
    </div>
    <div class="radio">
        <label class="radio-inline"><input type="radio" name="sex" value="Male" checked>Male   </label>
        <label class="radio-inline"><input type="radio" name="sex" value="Female" >Female</label>
    </div>
    <div class="form-group">
        <label for="dob">Date of Birth:</label>
        <input type="date" class="form-control" name="dob" required>
    </div>
    <div class="form-group">
        <label for="dod">Date of Death: (leave blank if alive)</label>
        <input type="date" class="form-control" name="dod">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>

<?php

include_once "config/database.php";
include_once "entities/actors.php";
include_once "entities/directors.php";

$firstName = $_GET["firstName"];
$lastName = $_GET["lastName"];
$sex = $_GET["sex"];
$post = $_GET["post"];
$dob = $_GET["dob"];
$dod = $_GET["dod"];

if ($post=="") {exit(1);}

$DBconn = new DBConn();
$db = $DBconn->getDbConn();
//echo "Created Db conn successfully<br/>";

if ($post=="actor") {
    $actors = new Actor($db);
    $actorRes = $actors->addActorInfo($firstName, $lastName, $sex, $dob, $dod);
    if ($actorRes) {
        echo "<b><br/>Success!! New Actor added successfully</b><br/>";
    } else {
        echo "<b><br/>Error:</b> ". $db->error. "<br/>";
    }
} else {
    //echo "Inside Director Info <br/>";
    $directors = new Director($db);
    $directorRes = $directors->addDirectorInfo($firstName, $lastName, $dob, $dod);
    if ($directorRes) {
        echo "<br/><b>Success!! New Director added successfully</b><br/>";
    } else {
        echo "<br/><b>Error</b>: " . $db->error. "<br/>";
    }
}

$DBconn->closeDBConn();
?>
</div>
</body>
</html>