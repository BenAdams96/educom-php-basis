<?php
/////////////////SETUP////////////////////
$host = "localhost";
$user = "root";
$password = "";
$dbname = "seyan_8";
$datasheet= "klanten";
$count = 0;
$cxn = mysqli_connect($host,$user,$password,$dbname) or die ("Couldn't connect to server");

if (isset($_POST['query'])){ //Check whether ORDER BY was asked
	$query = $_POST['query'];
}
else {
	$query = "SELECT * FROM ".$datasheet; //Default query, same as order by ID ASC
}


if (isset($_GET['sc'])){
	if ($_GET['sc'] == 1) {
		echo "Succesvol geupdate!";
	}
	if ($_GET['sc'] == 0) {
		echo "Gegevens ongewijzigd!";
	}
	echo "<br>";
}

$result = mysqli_query($cxn,$query) or die ("Couldn't execute query");
echo "Click ID# to edit. <br>Click ColumnName to sort.";
echo "<br><table border='1'>";


/////////////////CREATE HEADER OF TABLE///////////////////
for($i = 1; $i < mysqli_num_fields($result)+1; $i++) { //runs for number of columns, from 1 to +1 to be able to multiply by -1
    $field = mysqli_fetch_field($result);
	
	/////////SET BUTTON STATUS////////////////
	if (isset($_POST['hidden'.$i])){ //check wether button was pressed before
		if ($_POST['hidden'.$i] == 0) { //if button pressed first time, set ASC
			$buttonvalue = 1;
		}
		else { //if button pressed before, toggle ASC-DESC
			$buttonvalue = $_POST['hidden'.$i] * -1;
		}
	}
	else {
		$buttonvalue = 0; //set default state button, not sorted
	}
	///////////////////////////////////////////
	
	
	///////////////PRINT HEADER & BUTTONS///////////////////
	echo "<th>
	<form action='opdracht10_voorbeeld.php' method='POST'>\n
	<input type='submit' name='column".$i."' value='".$field->name."' />\n";

	for ($j=1; $j<mysqli_num_fields($result) +1; $j++){ //create buttons and add hidden to store togglestatus. Every button stores data of all other buttons
		if ($j == $i) {
			echo "<input type='hidden' name='hidden".$j."' value='".$buttonvalue."' />\n"; //change the hidden data of the button to new buttonvalue
		}
		else {
			if (isset($_POST['hidden'.$j])) {
				echo "<input type='hidden' name='hidden".$j."' value='".$_POST['hidden'.$j]."' />\n"; //If data is available for data from other buttons, copy it
			}
			else {
				echo "<input type='hidden' name='hidden".$j."' value='0' />\n"; //If no previous data is available, set to default 0
			}
		}
	}
	
	if (isset($_POST['column'.$i])){ //Check wether this was pressed button, if yes print +/-
		if ($buttonvalue == 1){ //echo + if ASC
			echo "+";
		}
		if ($buttonvalue == -1){ //echo - if DESC
			echo  "-";
		}
	}
	
	echo "<input type='hidden' name='query' value='SELECT * FROM ".$datasheet." ORDER BY ".$field->name;

	if ($buttonvalue == 0 || $buttonvalue == -1) { //Order by DESC when ASC
		echo " ASC";
	}
	if ($buttonvalue == 1) {//Order by ASC when DESC
		echo " DESC";
	}
	echo "' />\n";
	echo "</form>\n\n";
	/////////////////////////////////////////////////////////
}
echo "</tr><tr>";



//////////////////CREATE DATABASE TABLE//////////////////////////
while ($row = mysqli_fetch_assoc($result)) { //draw data from database
	foreach($row as $value) {
		$count++; //registrate count to break table at end of databaserow
		/////////////////
		
		if($count == 1) {
			echo "<td><form action='opdracht10_edit.php' method='POST'><input type='submit' name='id' value='".$value."'></form></td>";
		}
		if($count > 1 && $count <= mysqli_num_fields($result)){
			echo "<td>".$value."</td>";
		}		
		if ($count == mysqli_num_fields($result)){ //count to the number of columns, next row
						echo "</tr><tr>";
			$count = "0";
		}	
	}
}
echo "</tr></table>";

//echo "<form action='opdracht10.php' method='POST'><input type =submit name='test' value='".$test."' />";

mysqli_close($cxn);
?>