<?php

include("Bear.php");
include("Grizzly.php");
include("Panda.php"); //Question: wordt onoverzichtelijk met veel classes

//gewone beer maken
$bear = new Bear("Baloo", 8, 180);

//grizzly maken
$grizzly = new Grizzly("Bruno", 12, 300, 30);
$panda = new Panda("Po", 12, 300, True);

echo "<h2>Bear</h2>";
echo $bear->getInfo();

echo "<h2>Grizzly</h2>";
echo $grizzly->getInfo() . "<br>";
echo $grizzly->getGrizzlyInfo() . "<br>";

if ($grizzly->roars()) {
    echo "This Panda bear can roar!";
} else{
    echo "This Panda bear can not roar!";
}

echo "<h2>Panda</h2>";
// echo $panda->getInfo() . "<br>";
echo $panda->getPandaInfo() . "<br>";

if ($panda->roars()) {
    echo "This Panda bear can roar!";
} else{
    echo "This Panda bear can not roar!";
}

?>