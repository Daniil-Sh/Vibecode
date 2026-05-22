<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test api</title>
</head>
<body>
    <button action="">

    </button>
</body>
</html>
<?php

require_once __DIR__.'/vendor/autoload.php';
require_once "classes/UtilityBitrix.php";
require_once "classes/UtilityTelegram.php";

$bitrix = My_InitializeBitrix();
$bot = My_InitializeBot();
$newConnection = new mysqli(
    'localhost',
    'root',
    null,
    'test'
);
//$manualMode = true;
//$command = CommandList::UpdateUser;
//$chat_id = 985114939;
//$messageText = mb_convert_encoding('Обновить информацию обо мне', "UTF-8");
//$result = ["message" => ["text" => $messageText, "chat" => ["id" => $chat_id]]];
//
//
//require_once "classes/Reporting.php";

print_r(My_InitializeReportingBot()->getWebhookInfo());

// $result = My_FindBitrixUser($bitrix, ["PHONE" => "+79963200144"]);
// print_r($result);
// echo('<p></p><p></p>');


