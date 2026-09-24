<?php

$pages = array(
    array("Pagina 1", "world0.jpg", "aarde realistisch"),
    array("Pagina 2", "world1.jpg", "aarde getekend"),
    array("Pagina 3", "world2.png", "aarde cartoon")
);

function show_page($page)
{
    $output = $page[0] . "<br>";
    $output .= "<img src=$page[1] width='200' height='200'><br>";
    $output .= $page[2];

    return $output;
}

$id = 0;

//check of andere pagina is gekozen
if (isset($_GET["page"])) {
    $id = $_GET["page"];
}

?>

<html>
<body>

    <a href="?page=0">Pagina 1</a><br>
    <a href="?page=1">Pagina 2</a><br>
    <a href="?page=2">Pagina 3</a><br><br>

    <?php echo show_page($pages[$id]); ?>

</body>
</html>