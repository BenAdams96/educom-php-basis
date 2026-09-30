<?php

include("Webpage.php");

//nieuwe pagina maken
$page = new WebPage("Eerste website");

$page->showHeader();
$page->showContent("Welkom op mijn eerste website die ik gebouwd heb door middel van OOP.");
$page->showFooter();

?>