<?php
// Output EPG data in JSON format
header('Content-Type: application/json');

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$local_ip = getHostByName(php_uname('n'));
$serverIP = @file_get_contents('https://api.ipify.org');
$host = ($_SERVER['SERVER_ADDR'] !== '127.0.0.1' && $_SERVER['SERVER_ADDR'] !== 'localhost') ? $_SERVER['HTTP_HOST'] : $local_ip;
if (strpos($host, $_SERVER['SERVER_PORT']) === false) {
    $host .= ':' . $_SERVER['SERVER_PORT'];
}
$HostUrl = $protocol . $host . str_replace(" ", "%20", str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']));



$serverAddress = $_SERVER['HTTP_HOST'] ?? 'default.server.address';
$serverPort = $_SERVER['SERVER_PORT'] ?? '8000';

$m3u .= '#EXTM3U x-tvg-url="https://avkb.short.gy/tsepg.xml.gz"' . PHP_EOL . PHP_EOL;

include('sliv.php');
include('zee5m3u.php');

// URL of the API
$url = "jio.json";

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
  $url_id = $ch['url_id'];
  
  $m3u .= '#KODIPROP:inputstream.adaptive.license_type=clearkey' . PHP_EOL;
  $m3u .= '#KODIPROP:inputstream.adaptive.license_key=' . $HostUrl . "$id.key" . PHP_EOL;
  $m3u .= '#EXTINF:-1 tvg-id="' . $id . '" tvg-logo="' . $logo . '" group-title="JioTV ' . $genre . '", ' . $name . PHP_EOL;
  //$m3u .= "https://jiotvmblive.cdn.jio.com/bpk-tv/" . $url_id . "BTS/output/index.mpd%7Ccookie=$hmac" . PHP_EOL . PHP_EOL;
  $m3u .= $HostUrl . "$id.mpd" . PHP_EOL . PHP_EOL;
}

//file_put_contents("jions.m3u", $m3u);
//echo "Done!!!!";
echo $m3u;

?>