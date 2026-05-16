<?php

header('Content-Type: application/json');

$apiKey = "7bfa757b57890c246e2f4f4a6be155b8";

$lat = $_GET['lat'] ?? '';
$lon = $_GET['lon'] ?? '';

$url =
"https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&appid=$apiKey&units=metric";

$response = file_get_contents($url);

$data = json_decode($response,true);

if(isset($data['main'])){

echo json_encode([
'city'=>$data['name'],
'temp'=>$data['main']['temp'],
'humidity'=>$data['main']['humidity'],
'wind'=>$data['wind']['speed'],
'weather'=>$data['weather'][0]['main'],
'icon'=>$data['weather'][0]['icon']
]);

}else{

echo json_encode([
'error'=>'API gagal'
]);

}
?>