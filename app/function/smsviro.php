<?php
function Send_SMS($to,$text){
    $pecah              = explode(",",$to);
    $jumlah             = count($pecah);
    $from               = "coba"; //Sender ID or SMS Masking Name, DO NOT LEAVE BLANK, sms will not be sent
    $apikey             = "019d79d4831ab5edd9b529e8deb0c1e1-ca4b5ee9-3db6-42f3-819b-1127a99650bb"; //Get your API Key from our sms dashboard
    $postUrl            = "https://api.smsviro.com/restapi/sms/1/text/advanced"; # DO NOT CHANGE THIS
    
    for($i=0; $i<$jumlah; $i++){
        if(substr($pecah[$i],0,2) == "62" || substr($pecah[$i],0,3) == "+62"){
            $pecah = $pecah;
        }elseif(substr($pecah[$i],0,1) == "0"){
            $pecah[$i][0] = "X";
            $pecah = str_replace("X", "62", $pecah);
        }else{
            echo "Invalid mobile number format";
        }
        $destination = array("to" => $pecah[$i]);
        $message     = array("from" => $from,
                             "destinations" => $destination,
                             "text" => $text,
                             "smsCount" => 1);
        $postData           = array("messages" => array($message));
        $postDataJson       = json_encode($postData);
        $ch                 = curl_init();
        $header = array("Content-Type:application/json", "Accept:application/json", "Authorization: App ".$apikey);
        
        curl_setopt($ch, CURLOPT_URL, $postUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataJson);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $responseBody = json_decode($response);
        curl_close($ch);
    }   
}

?>