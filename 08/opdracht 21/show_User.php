<?php

include("User.php");

$user1 = new User(1, "world1.jpg");

//show passport, the rest is handled by the Class
echo $user1->showPassport();

//OLD CODE (to reuse):
// echo "ID is: " . $user1->getId();
// echo "<br>";

//check if image
// if($user1->checkFileName()){
//     echo $user1->fileName . " is an image.";
// }else{
//     echo $user1->fileName ."is not an image.";
// }
// echo "<br>";

//show image
// echo $user1->showImage();
// echo "<br>";


$user2 = new User(2, "world2.png");

//show passport, the rest is handled by the Class
echo $user2->showPassport();

//OLD CODE (to reuse):
// echo "ID is: " . $user2->getId();
// echo "<br>";

//check if image
// if($user2->checkFileName()){
//     echo $user2->fileName . " is image";
// }else{
//     echo $user2->fileName . " is not image";
// }
// echo "<br>";

//show image
// echo $user2->showImage();
?>