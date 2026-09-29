<?php 

function show_form() {
    $form_data  = "<html><body>Please login:<form action='login_cookie.php' method='POST'>";
    $form_data .= "<input type='text' name='user'>";
    $form_data .= "<input type='submit' value='login'>";
    $form_data .= "</form></body></html>";

    echo $form_data;
}

//check of er op logout is gedrukt
if (isset($_POST["logout"])) {
    setcookie("user", "", time() - 1); //cookie leeg maken en verloopdatum in verleden zetten
    header("Location: login_cookie.php"); //pagina opnieuw laden zodat cookie weg is
    exit;
}

//check of login formulier is verstuurd
if (isset($_POST["user"])) {
    setcookie("user", $_POST["user"]); //naam opslaan in cookie
    header("Location: login_cookie.php"); //pagina opnieuw laden zodat cookie beschikbaar is
    exit;
}

//check of user cookie bestaat
if (isset($_COOKIE["user"])) {
    echo "Welcome " . $_COOKIE["user"] . "!"; //als cookie bestaat is gebruiker ingelogd
    ?>

    <form method="POST">
        <!--stuurt logout mee via POST-->
        <button type="submit" name="logout">
            Log out
        </button>
    </form>

    <?php

} else {
    show_form();
}

?>