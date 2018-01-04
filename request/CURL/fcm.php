<?php
include '../../handles/AuthKeys.php';
class fcm{
    
    public function getUsersHeaders(){
        $headers = array();
        $headers[] = "Content-Type: application/json";
        $headers[] = "Authorization: key=".FCMKEY::USERS_SERVER_KEY;
        return $headers;
    }

    public function getShopsHeaders(){
        $headers = array();
        $headers[] = "Content-Type: application/json";
        $headers[] = "Authorization: key=".FCMKEY::SHOPS_SERVER_KEY;
        return $headers;
    }

    public function sendUsersNotification($to, $message){
        $data = array(
            "to" => $to,
            "data" =>  array(
                "incoming" => "incoming"
            ),
            "priority" => "high",
            "notification" => array(
                "title" => "WatzNear",
                "message" => $message,
                "sound" => "sound"
            )
                
        );
        return $this->pushfcm($data, $this->getUsersHeaders());
    }

    public function sendShopsNotification($to){
        $data = array(
            "to" => $to,
            "data" =>  array(
                "incoming" => "incoming"
            ),
            "priority" => "high",
            "notification" => array(
                "title" => "WatzNear",
                "message" => "New Order Received",
                "sound" => "sound"
            )
                
        );
        return $this->pushfcm($data, $this->getShopsHeaders());
    }    

    public function pushfcm($data, $headers){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return false;
        }
        curl_close ($ch);
        $res = json_decode($result);
        if($res->success === 1){
            return true;
        }else{
            return false;
        }
    }

}
?>