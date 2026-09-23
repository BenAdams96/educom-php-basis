<?php

$columns = array ("first_name", "last_name", "address");


//is er op een knop geklikt?
if (isset($_POST['column_name'])) {
	echo "Er is geklikt op: ".$_POST['column_name'];
	echo "<br>";
	//zet de button_name zodat we weten op welke column we straks moeten sorteren
	$button_name = $_POST['column_name'];
	//zet nu voor deze button de juiste ASC of DESC in het formulier
	//controleer dus wat de POST heeft en zet het tegenovergestelde in de form
	if ($_POST[$button_name."_sort_order"] == "ASC") {
		${$button_name."_sort_order"} = "DESC";	
	} else {
		${$button_name."_sort_order"} = "ASC";
	}
	echo "De query die uitgevoerd wordt is: SELECT * FROM tabel ORDER BY ".$button_name." ".${$button_name."_sort_order"};
} else {
	//dit is de eerste keer dat je binnenkomt
	//zet dus alles op "default"
	for ($i=0; $i < sizeof($columns); $i++) {
		${$columns[$i]."_sort_order"} = "ASC";
	}
	echo "Nog niets geklikt.";
	echo "<br>";
	echo "De query die uitgevoerd wordt is: SELECT * FROM tabel ORDER BY first_name ASC";
	
}

//maak hier de form met de juiste parameters
echo "\n<form action='uitleg_opdracht10.php' method='POST'>\n";
		
for ($i=0; $i < sizeof($columns); $i++) {
	//als de button_name == $columns[i], hoeven we niets te doen, want dat is de button die we al gezet hebben in regel 14
	//anders moeten we de "oude" sort_order uit de POST halen en in het form zetten
	if (!empty($_POST) && $button_name != $columns[$i]) {
		${$columns[$i]."_sort_order"} = $_POST[$columns[$i]."_sort_order"];
	}
	echo "<input type='hidden' name='".$columns[$i]."_sort_order' value='".${$columns[$i]."_sort_order"}."'>\n";
	echo "<input type='submit' name='column_name' value='".$columns[$i]."'>\n";
}

echo "</form>\n";


//laat zien wat er in de POST zat

if (!empty($_POST)) {
	echo "Dit zat er in het formulier:<br>";
	echo "<pre>";
	var_dump($_POST);
	echo "</pre>";
}
?>