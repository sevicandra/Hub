<?php
use App\Models\User;
function notifikasiAgenda($agenda,$waktu,$tempat,$meetingId,$meetingPassword,$linkRapat,$linkAbsensi){
    $ch = curl_init();
    foreach (User::where('email_verified_at', '!=', null)->get() as $key) {
        $text = array("name" => "notifikasiagenda", "language"=>array("code"=>"id"),"components"=>[array("type"=>"body","parameters"=>[array("type"=>"text", "text"=>$agenda),array("type"=>"text", "text"=>$waktu),array("type"=>"text", "text"=>$tempat),array("type"=>"text", "text"=>$meetingId),array("type"=>"text", "text"=>$meetingPassword),array("type"=>"text", "text"=>$linkRapat),array("type"=>"text", "text"=>$linkAbsensi)])]);
        $postData = array("messaging_product" => "whatsapp", "to"=>$key->nomorHP, "type"=>"template", "template"=>$text);
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

    }
    
    curl_close($ch);
}
?>