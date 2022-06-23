<?php

function sendDocument($to, $namaDokumen, $idDokumen, $APIKey, $phoneNumber){
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
    
    $text = array(
        "name" => "send_document",
        "language"=>array(
            "code"=>"id"
        ),
        "components"=>array(
            array(
                "type"=>"header",
                "parameters"=>[
                    array(
                        "type"=>"document",
                        "document"=>array(
                            "id"=>$idDokumen
                        )
                    )
                ]
            ),
            array(
                "type"=>"body",
                "parameters"=>[
                    array(
                        "type"=>"text",
                        "text"=>$namaDokumen
                    ),
                ]
            )
        )
    );
    
    $postData = array("messaging_product" => "whatsapp", "to"=>6281299084970, "type"=>"template", "template"=>$text);
    $postDataJson = json_encode($postData);
    
    $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/v13.0/'.$phoneNumber.'/messages');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataJson);
        $headers = array();
        $headers[] = 'Authorization: Bearer '.$APIKey;
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        
    curl_close($ch);
}
