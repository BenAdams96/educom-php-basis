<?php

include("classes_bear.php");

//gewone beer maken
$bear = new Bear("Baloo", 8, 180);

//grizzly maken
$grizzly = new Grizzly("Bruno", 12, 300, "North-America", "Fish");

echo "<h2>Bear</h2>";
echo $bear->getInfo();

echo "<h2>Grizzly</h2>";
echo $grizzly->getInfo() . "<br>";
echo $grizzly->getGrizzlyInfo() . "<br>";

if ($grizzly->roars()) {
    echo "This grizzly bear can roar!";
}

?>