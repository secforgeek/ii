<?php
$url = "http://maps.googleapis.com/maps/api/geocode/xml?latlng=";
$endurl = "&sensor=true";

$ch = curl_init();
$link = $url.$postBody->lat.','.$postBody->lng.$endurl;
curl_setopt($ch, CURLOPT_URL, $link);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
$output = curl_exec($ch);

if($output == FALSE){
    $output->error(Constants::ERROR_TECHNICAL_ISSUE, Constants::HTTP_ERROR_BADREQUEST);
    exit();
}
curl_close($ch);
$xml = simplexml_load_string($output);
if($xml->status == "OK"){
    foreach ($xml->result->address_component as $address) {
        if("administrative_area_level_2" ==  trim($address->type)) {
            $city = $address->long_name;
        }
    }
}else{
    $output->error(Constants::ERROR_TECHNICAL_ISSUE."Test 8", Constants::HTTP_ERROR_BADREQUEST);
    exit();                                        
}
$selectQuery = $db->selectQuery(Constants::QUERY_SELECT_CLI_LATLNG_EMAIL, array(":city" => $city), Constants::DB_FETCH_ASSOC);
?>