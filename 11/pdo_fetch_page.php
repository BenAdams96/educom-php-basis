<?php

//altijd de links laten zien
echo "<a href='pdo_fetch_page.php?fetch_method=1'>PDO::FETCH_ASSOC</a><br><br>";
echo "<a href='pdo_fetch_page.php?fetch_method=2'>PDO::FETCH_BOTH</a><br><br>";
echo "<a href='pdo_fetch_page.php?fetch_method=3'>PDO::FETCH_LAZY</a><br><br>";
echo "<a href='pdo_fetch_page.php?fetch_method=4'>PDO::FETCH_OBJ</a><br><br>";


//checken of er een fetch methode is via GET
if (isset($_GET["fetch_method"])) {

    $fetch_method = $_GET["fetch_method"];

    //connectie maken met database
    try {
        $dbh = new PDO(
            "mysql:host=localhost;dbname=webshop",
            "root",
            ""
        );
    } catch (PDOException $error) {
        echo $error->getMessage();
    }

    //query klaarmaken en uitvoeren
    $sth = $dbh->prepare("SELECT * FROM user");
    $sth->execute();

    //afhankelijk van nummer andere fetch methode gebruiken
    switch ($fetch_method) {
        case 1:
            $result = $sth->fetch(PDO::FETCH_ASSOC); //associatieve array
            break;
        case 2:
            $result = $sth->fetch(PDO::FETCH_BOTH); //kolomnamen en nummers als keys
            break;
        case 3:
            $result = $sth->fetch(PDO::FETCH_LAZY); //lazy object
            break;
        case 4:
            $result = $sth->fetch(PDO::FETCH_OBJ); //teruggeven als object
            break;
        default:
            $result = "Geen methode gekozen";
    }

    //resultaat onder de links laten zien
    echo "<pre>";
    var_dump($result);
    echo "</pre>";
}

?>