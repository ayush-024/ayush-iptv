<?php
// Output EPG data in JSON format
header('Content-Type: application/json');

$id = $_GET['id'];
if (empty($id)) {
    echo json_encode(["error" => "Missing Parameter ?id="]);
    exit();
}

$curl = curl_init();

$postData = json_encode([
    "X-API-Key" => "babel-5d410c0f8631f22dc0ec64e98f",
    "X-Channel-ID" => $id
]);

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://babel-in.xyz/jplus/key',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $postData,
    CURLOPT_HTTPHEADER => array(
        'User-Agent: Babel/5.0',
        'Content-Type: application/json'
    ),
));

$response = curl_exec($curl);

curl_close($curl);

$data = json_decode($response, true);

$key = $data['keys'] ?? null;
if (!empty($key)) {
    echo json_encode($key);
} else {
    echo json_encode(["error" => "No key found! Please check id again."]);
}
?>

	