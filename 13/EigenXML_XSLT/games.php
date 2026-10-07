<?php

//xml document inladen
$xml_doc = new DOMDocument();
$xml_doc->load("games.xml");

//xslt stylesheet inladen
$xslt_doc = new DOMDocument();
$xslt_doc->load("games.xslt");

//xslt processor maken
$processor = new XSLTProcessor();

//stylesheet toevoegen
$processor->importStylesheet($xslt_doc);

//xml omzetten met xslt en resultaat laten zien
echo $processor->transformToXML($xml_doc);

?>