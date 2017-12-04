<?php

$password = "password";
$hash256 = hash("sha256", $password);
echo $hash256."<br>";
$md5 = hash("md5",$hash256);
echo password_hash($md5, PASSWORD_DEFAULT);


//password1     =   0b14d501a594442a01c6859541bcb3e8164d183d32937b851835442f69d5c94e
//password      =   5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8

?>