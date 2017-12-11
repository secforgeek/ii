<?php

class DistanceCalc{

    function CalculateDistance($latitude1, $longitude1, $latitude2, $longitude2){  
            $theta = $longitude1 - $longitude2;
            $miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos (deg2rad($latitude2)) * cos(deg2rad($theta)));
            $miles = acos($miles);
            $miles = rad2deg($miles);
            $miles = $miles * 60 * 1.1515; //compact('miles','kilometers'); 
            $kilometers = $miles * 1.609344;
            return round($kilometers,2);
    }
}

?>