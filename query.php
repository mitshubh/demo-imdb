</!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Shubham_Mittal - CS 143 Project 1B</title>
</head>
<body>
	<h1><center>A Web Query Interface</center></h1>
	<center>Written by <b>Shubham Mittal</b></center>
	<center>UID: 104774903</center>
	<center>Built using PHP & HTML</center>
	<ul><u>Assumptions: </u>
		<li>Users always issue correct <b>SELECT</b> queries</li>
		<li>User inputs can be trusted</li>
		<li><b>NOTE:</b>Refer the source file for the list of constraints</li>
	</ul>
	<form method="GET" action = "query.php">
		<textarea name="query" rows=10 cols=100 ><?php 
			if(isset($_GET['query'])) { 
				echo htmlentities ($_GET['query']);
			}?>
		</textarea>
		<br>
		<button>Submit Query</button>
	</form>

<?php
$inputQuery = $_GET["query"];
if ($inputQuery=="") {exit(1);}
$db = new mysqli('localhost', 'cs143', '', 'CS143');

if ($db -> connect_errno >0) {
	die('Unable to connect to database [' . 	$db->connect_error . ']');
}
echo "<b>Result of query: $inputQuery <br/></b>";
if (!($rs = $db->query($inputQuery))) {
	$errMsg = $db->error;
	print "Incorrect Query : $errMsg <br/>" ;
	exit(1);
}
if (($rs->num_rows)>0) {
	$iter=1;
	echo "<table border='1'>";
	while ($row = $rs->fetch_assoc()) {
		if ($iter==1) {
			echo "<tr>";
			foreach($row as $cname => $cvalue){
				echo "<th>".$cname."</th>";
			}
			echo "</tr>";
		}
		echo "<tr>";
        foreach($row as $cname => $cvalue){
        	echo "<td>".$cvalue."</td>";
    	}
    	echo "</tr>";
        $iter++;
    }
    echo "</table>";
} else {
	echo "<table border='1'>";
    echo "<tr>";
	while ($row = $rs->fetch_field()) {
		echo "<th>".$row->name."</th>";
	}
	echo "</tr>";
	echo "</table>";
}

$rs->free();
$db->close();
?>

</body>
</html>