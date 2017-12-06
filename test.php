<?php
include 'handles/AuthKeys.php';
include 'handles/Auth.php';
include 'handles/Constants.php';

$auth = new Auth();
$data = array(
    "usr" => "Gajendra",
    "type" => "client",
    "email" => "r.gajendran3@gmail.com"
);

$etoken = <<<EOD
eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE1MTI0NzQ4MjIsIm5iZiI6M
TUxMzE3OTYyMiwiaXNzIjoiZ3Nkcm9pZC5jb20iLCJkYXRhIjp7InVzciI6IkdhamVuZHJ
hIiwidHlwZSI6ImNsaWVudCIsImVtYWlsIjoici5nYWplbmRyYW4zQGdtYWlsLmNvbSJ9f
Q.IKVb_KBehxjxWEECHlMreebprocxq4HKnS-vzJMV4ImmD-3xgUOHNWp1fX4BJCvw2ort
AGppgWDFD1L4NaKacFmSG05A3PgY4vn6N5x1HLLlUvl81P66FF1w75pq-Q89tGRv8eYp7b
ftg9iMEsCTkeBOOHmQX_-e7qb2CDKEPh0
EOD;
$token = $auth->generateToken($prk, $data, "+30 day");

echo $token."<br><br>";

try{
    echo "Decode <br><br>";
    echo print_r($auth->decodeToken($token, $puk), true);
}catch(Exception $e){
    echo $e->getMessage();
}

echo strtotime("+30 day", time());

?>