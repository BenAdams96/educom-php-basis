<?php

require "model.php";

//users ophalen uit model
$users = getUsers();

//view laten zien
require "view.php";

?>