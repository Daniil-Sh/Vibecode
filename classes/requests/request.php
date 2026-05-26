<?php
require_once 'classes/workEnv/readEnv.php';

function sendRequest($url, $params = [], $body = null, $method = 'POST') {
    
    $result = [];

    $apiKey = readEnvKey("!VIBECODE_API_KEY");
    $curl = curl_init($url);
    $params[] = 'X-Api-Key: ' . $apiKey;
    $params[] = 'Content-Type: application/json';
    
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $params);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    if (isset($body)) {   
        curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
    }

    $result["response"] = curl_exec($curl);
    $result["httpCode"] = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $result["curlError"] = curl_error($curl);
    curl_close($curl);

    return $result;
}