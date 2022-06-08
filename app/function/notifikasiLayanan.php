<?php

function notifikasiLayanan($agenda,$Pesan,$to){

    if(substr($to,0,2) == "62"){
        $to = $to;
    }elseif(substr($to,0,3) == "+62"){
        $to = substr($to, 1);
    }elseif(substr($to,0,1) == "0"){
        $to[0] = "X";
        $to = str_replace("X", "62", $to);
    }else{
        echo "Invalid mobile number format";
    }

    $ch = curl_init();
        $text = array("name" => "notifikasilayanan", "language"=>array("code"=>"id"),"components"=>[array("type"=>"body","parameters"=>[array("type"=>"text", "text"=>$agenda),array("type"=>"text", "text"=>$Pesan)])]);
        $postData = array("messaging_product" => "whatsapp", "to"=>$to, "type"=>"template", "template"=>$text);
        $postDataJson = json_encode($postData);
        curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/v13.0/113309384721694/messages');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataJson);
        $headers = array();
        $headers[] = 'Authorization: Bearer EAAKS6jFlEfkBAGUDqGhQRTzVBfaW5ZAX67ZB3RQOzOF2iOLf0OSNJCFaSN2u2Ro827kZBEJP6gWcmpGjAXEAjNTHAXNKo9zcUCJ9nwBsX4OWblB8AsqfCnMtKUr2pGSmJ5lfhJdTgamW6j9qndje2PJpVXGjEpVVSsTA47VKL6QISOghvf8';
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
    
    curl_close($ch);
}
?>