<?php

header('Content-Type: application/json');
  
  $curl = curl_init();
  
  curl_setopt_array($curl, array(
    CURLOPT_URL =>  'https://babel-in.xyz/tata/sliv',
    CURLOPT_RETURNTRANSFER =>  true,
    CURLOPT_ENCODING =>  '',
    CURLOPT_MAXREDIRS =>  10,
    CURLOPT_TIMEOUT =>  0,
    CURLOPT_FOLLOWLOCATION =>  true,
    CURLOPT_HTTP_VERSION =>  CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST =>  'POST',
    CURLOPT_POSTFIELDS => '{
      "X-API-Key": "babel-5d410c0f8631f22dc0ec64e98f",
      "X-Channel-ID": 15
  }',
    CURLOPT_HTTPHEADER =>  array(
      'User-Agent: Babel/5.0',
      'Content-Type: application/json'
    ),
  ));
  
  $response = curl_exec($curl);
  
  curl_close($curl);
  
  $responseData = json_decode($response, true);
  
 $hmacsliv = $responseData['hdnea'];

// URL of the API
$url = "sliv.json";

// Fetch the JSON content from the API
$json = file_get_contents($url);

// Decode the JSON content into an associative array
$datas = json_decode($json, true);

foreach($datas as $ch)
{
  $id = $ch['id'];
  $logo = $ch['logo'];
  $name = $ch['name'];
  $genre = $ch['genre'];
  $url = $ch['url'];
  
  $m3u .= '#EXTINF:-1 tvg-id="' . $id . '" tvg-logo="' . $logo . '" group-title="SonyLiv", ' . $name . PHP_EOL;
  $m3u .= $url . "?" . $hmacsliv . PHP_EOL . PHP_EOL;
}


?>