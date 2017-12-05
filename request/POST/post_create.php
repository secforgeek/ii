<?php
 include 'db/DB.php';
 
 $db = new DB();
$d = array(
    ":email" => "akshayarunkumar@gmail.com",
    ":fname" => "AK",

);
 if($db->InsertUpdateQuery("UPDATE user_profile SET firstname=:fname WHERE email=:email", $d, 1)){
    echo "Success";
 }else{
    echo "Failed";
 }

 //update - "UPDATE user_profile SET firstname=:fname WHERE email=:email"

 // INSERT INTO user_profile (type, email, firstname, lastname, country_code, mobile) VALUES (:type, :email, :firstname, :lastname, :country, :mobile)


?>