<?php

use App\Models\reminder;

function notifikasiPersonal($id,$pengirim,$pesan,$APIKey,$phoneNumber){
    $ch = curl_init();
    foreach (reminder::where('id', $id)->first()->tujuan as $key) {
        $text = array("name" => "reminder_personal", "language"=>array("code"=>"id"),"components"=>[array("type"=>"body","parameters"=>[array("type"=>"text", "text"=>$pengirim),array("type"=>"text", "text"=>$pesan)])]);
        $postData = array("messaging_product" => "whatsapp", "to"=>$key->nomorHP, "type"=>"template", "template"=>$text);
        $postDataJson = json_encode($postData);
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
    }
    
    curl_close($ch);
}
?>