<?php
use App\Models\User;
function notifikasiAgenda($agenda,$waktu,$tempat,$meetingId,$meetingPassword,$linkRapat,$linkAbsensi){
    $ch = curl_init();
    foreach (User::where('email_verified_at', '!=', null)->get() as $key) {
        $text = array("name" => "notifikasiagenda", "language"=>array("code"=>"id"),"components"=>[array("type"=>"body","parameters"=>[array("type"=>"text", "text"=>$agenda),array("type"=>"text", "text"=>$waktu),array("type"=>"text", "text"=>$tempat),array("type"=>"text", "text"=>$meetingId),array("type"=>"text", "text"=>$meetingPassword),array("type"=>"text", "text"=>$linkRapat),array("type"=>"text", "text"=>$linkAbsensi)])]);
        $postData = array("messaging_product" => "whatsapp", "to"=>$key->nomorHP, "type"=>"template", "template"=>$text);
        $postDataJson = json_encode($postData);
        curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/v13.0/108001318590564/messages');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataJson);
        $headers = array();
        $headers[] = 'Authorization: Bearer EAAkWD2DHGSoBAEZAxf2tSnOhZBXfl39KMeYGjYWDKhl0NlUaBNdtgkuGchwAZCLADO4YKDvg5JjLgE2nBcSjofm2s8ZB0MB4dCIrPZCDlfw443rL89ZAVzKI3DdnpHXnUTgUmltlI2rBQv9GSzzPxKJeI9loZBTUjrZAtJmfcZBlP2ZBkec9k8m3FtiP5GwmOVKgMW21Dgl9SRkQZDZD';
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

    }
    
    curl_close($ch);
    return var_dump($postDataJson);
    var_dump($result) ;
}
?>