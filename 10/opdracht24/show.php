<?php

require "db.php";

try {

    //connectie maken met database via PDO
    $dbh = new PDO(
        "mysql:host=$host;dbname=$dbname",
        $username,
        $password
    );

    //query voorbereiden en uitvoeren
    $sth = $dbh->prepare("SELECT * FROM items");
    $sth->execute();

    //alle items ophalen als associatieve array
    $items = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $error) {

    die("Database fout: " . $error->getMessage());
}

?>

<h2>Items</h2>

<table border="1">

    <tr>
        <th>ID</th>
        <th>Naam</th>
        <th>Prijs</th>
        <th>Aanpassen</th>
    </tr>

    <?php foreach ($items as $item) { ?>

        <tr>
            <td><?php echo $item["id"]; ?></td>
            <td><?php echo $item["naam"]; ?></td>
            <td><?php echo $item["prijs"]; ?></td>

            <td>
                <a href="update.php?id=<?php echo $item["id"]; ?>">
                    Aanpassen
                </a>
            </td>
            <br>
        </tr>
        
    <?php } ?>

</table>
<a href="insert.php">Nieuw item toevoegen</a>