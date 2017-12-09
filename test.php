<?php
function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2) {    
$theta = $longitude1 - $longitude2;
$miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos (deg2rad($latitude2)) * cos(deg2rad($theta)));
$miles = acos($miles);
$miles = rad2deg($miles);
$miles = $miles * 60 * 1.1515;
$kilometers = $miles * 1.609344;
return compact('miles','kilometers'); 
}

$latitude = 53.800755;
$longitude = -1.549077;
$latitude2= 53.795984;
$longitude2 = -1.759398;

$point1 = array('lat' => number_format ($latitude,4,'.',''), 'long' => number_format ($longitude,4,'.',''));
$point2 = array('lat' => number_format ($latitude2,4,'.',''), 'long' => number_format ($longitude2,4,'.',''));
$distance = getDistanceBetweenPointsNew($point1['lat'], $point1['long'], $point2['lat'], $point2['long']);
print_r($distance);

?>