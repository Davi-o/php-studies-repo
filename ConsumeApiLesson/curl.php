<?php
$country = "brasil";
$url = "https://restcountries.eu/rest/v2/name/".$country;

$request = curl_init($url);

curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($request, CURLOPT_SSL_VERIFYPEER, 0);

$response = curl_exec($request);

curl_close($request);

print_r($response);