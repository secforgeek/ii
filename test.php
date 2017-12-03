<?php

$email = "r.gajendran3@gmail.com";
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo "Invalid Email";
}else{
    echo "Valid Email";
}


?>