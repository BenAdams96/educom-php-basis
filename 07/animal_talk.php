<?php

class Animal {
    public $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function talk() {
        return "Unknown";
    }

    public function eats() {
        return "Unknown";
    }

    public function barks() {
        return false;
    }
}

class Wolf extends Animal {

    public function talk() {
        return "Awooooo!";
    }

    public function eats() {
        return "vlees";
    }

    public function barks() {
        return true;
    }
}

class Dragon extends Animal {

    public function talk() {
        return "ROAAAAR!";
    }

    public function eats() {
        return "ridders";
    }
}

class Eagle extends Animal {

    public function talk() {
        return "Screeeech!";
    }

    public function eats() {
        return "vis";
    }
}


//standaard nog geen dier gekozen
$dier = null;

//check welk dier is gekozen
if (isset($_POST["animal"])) {
    switch ($_POST["animal"]) {
        case "wolf":
            $dier = new Wolf("Fenrir"); //hier worden de instanties gemaakt
            break;

        case "dragon":
            $dier = new Dragon("Smaug");
            break;

        case "eagle":
            $dier = new Eagle("Phenix");
            break;
    }
}

?>

<html>

<head>
    <title>Animal Talk</title>
</head>

<body>

    <h2>Kies een dier</h2>

    <form method="POST">
        <button type="submit" name="animal" value="wolf">Wolf</button>
        <button type="submit" name="animal" value="dragon">Draak</button>
        <button type="submit" name="animal" value="eagle">Adelaar</button>
    </form>

    <?php if ($dier) { ?>

        <hr>

        <h3>Gekozen dier: <?php echo $dier->name; ?></h3>

        <ul>
            <li>Geluid: <?php echo $dier->talk(); ?></li>
            <li>Eet: <?php echo $dier->eats(); ?></li>
            <li>Blaft: <?php echo $dier->barks() ? "ja" : "nee"; ?></li>
        </ul>

    <?php } ?>

</body>

</html>