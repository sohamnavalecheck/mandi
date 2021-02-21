<?php
    date_default_timezone_set("Asia/kolkata");
    //Data From Webhook
    $content = file_get_contents("php://input");
    $update = json_decode($content, true);
    $chat_id = $update["message"]["chat"]["id"];
    $message = $update["message"]["text"];
    $id = $update["message"]["from"]["id"];
    $username = $update["message"]["from"]["username"];
    $firstname = $update["message"]["from"]["first_name"];
    $message_id = $upadte["message"]["message_id"];

    //Start message
    if($message == "/start"){
        send_message($chat_id, <b>Hello there!!%0AType /cmds to know all my commands!!%0A%0ABot Made by: Soham Navale @sohamnavale1</b>", $message_id);
    }

elseif (strpos($message, "/cmds") === 0){
sendMessage($chatId, "<u>Bin lookup:</u> <code>/bin</code> xxxxxx%0A<u>Info:</u> <code>/info</code> To know ur info%0A%0A<b>Bot Made by: Soham Navale @sohamnavale1</b>", $message_id);
}

//Bin Lookup
   if(strpos($message, "/bin") === 0){
        $bin = substr($message, 5);
   $curl = curl_init();
   curl_setopt_array($curl, [
	CURLOPT_URL => "https://lookup.binlist.net/".$bin,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"authority: lookup.binlist.net",
		"accept: application/json",
		"accept-language: en-GB,en-US;q=0.9,en;q=0.8,hi;q=0.7",
		"origin: https://binlist.net",
		"https://binlist.net/",
		"sec-fetch-dest: empty",
		"sec-fetch-site: same-site"
	],
]);

$result = curl_exec($curl);
curl_close($curl);
$data = json_decode($result, true);
$bank = strtoupper($data['bank']['name']);
$country = strtoupper($data['country']['alpha2']);
$currency = strtoupper($data['country']['currency']);
$emoji = strtoupper($data['country']['emoji']);
$scheme = strtoupper($data['scheme']);
$Brand = strtoupper($data['brand']);
$type = strtoupper($data['type']);
  if ($scheme != null) {
        send_MDmessage($chat_id, "***
    Bin: $bin
Type: $scheme
Brand : $Brand
Bank: $bank
Country: $country $emoji
Currency: $currency
Credit/Debit:$type
Checked By @$username ***", $message_id);
    }
else {
    send_MDmessage($chat_id, "Enter Valid BIN", $message_id);
}
   }
    






    
//Send Messages with Markdown (Global)
      function send_MDmessage($chat_id, $message, $message_id){
       $apiToken = "1648835916:AAFLReqauS7M_9urC5Q-VfH12IUsiaXRFxo";
        $text = urlencode($message);
        file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?chat_id=$chat_id&text=$text&parse_mode=Markdown");
    }
    
?>
