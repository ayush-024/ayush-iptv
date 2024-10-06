
  <?php
  $id = $_GET['id'];
  header('Content-Type: application/json');
  
  $curl = curl_init();
  
  curl_setopt_array($curl, array(
    CURLOPT_URL =>  'https://babel-in.xyz/zee5/',
    CURLOPT_RETURNTRANSFER =>  true,
    CURLOPT_ENCODING =>  '',
    CURLOPT_MAXREDIRS =>  10,
    CURLOPT_TIMEOUT =>  0,
    CURLOPT_FOLLOWLOCATION =>  true,
    CURLOPT_HTTP_VERSION =>  CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST =>  'POST',
    CURLOPT_POSTFIELDS => '{
      "X-API-Key": "babel-5d410c0f8631f22dc0ec64e98f",
      "X-Channel-ID": 8
  }',
    CURLOPT_HTTPHEADER =>  array(
      'User-Agent: Babel/5.0',
      'Content-Type: application/json'
    ),
  ));
  
  $response = curl_exec($curl);
  
  curl_close($curl);
  
  $responseData = json_decode($response, true);
  
  foreach($responseData['data'] as $ch) {
  $id = $ch['id'];
  $logo = $ch['list_image'];
  $name = $ch['title'];
  $genre = $ch['genres'][0]['id'];
  $url = $ch['initialUrl'];
  
  $m3u .= '#EXTINF:-1 tvg-id="' . $id . '" tvg-logo="https://akamaividz.zee5.com/image/upload/w_522,h_294,c_scale,f_webp,q_auto:eco/resources/' . $id . '/channel_list/' . $logo . '" group-title="Zee 5", ' . $name . PHP_EOL;
  $m3u .= $url . PHP_EOL . PHP_EOL;
}


?>