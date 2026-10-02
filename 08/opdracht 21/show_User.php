<?php

require("User.php");

$user1 = new User(1, "world1.jpg");

//show passport, the rest is handled by the Class
echo $user1->showPassport();

$user2 = new User(2, "world2.png");

//show passport, the rest is handled by the Class
echo $user2->showPassport();
?>