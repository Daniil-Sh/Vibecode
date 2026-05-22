<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Приветствие от VibeCode</title>
    <style>
        body {
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }
        .card {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border-radius: 2rem;
            padding: 3rem;
            text-align: center;
            box-shadow: 0 25px 45px rgba(0,0,0,0.2);
            max-width: 600px;
            margin: 1rem;
        }
        h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        p {
            font-size: 1.2rem;
            line-height: 1.5;
            opacity: 0.9;
        }
        .badge {
            background: #ffd700;
            color: #333;
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            font-weight: bold;
            margin-top: 1.5rem;
            display: inline-block;
        }
    </style>
</head>
<body>
<div class="card">
    <h1>🚀 Привет, VibeCode!</h1>
    <p>Ваше PHP-приложение успешно развёрнуто на платформе.</p>
    <p>Этот лендинг работает через встроенный PHP‑сервер на порту <strong>3000</strong>.</p>
    <div class="badge">✨ Деплой выполнен вручную через API ✨</div>
</div>
</body>
</html>
<?php

//require_once __DIR__.'/vendor/autoload.php';
//require_once "classes/UtilityBitrix.php";
//require_once "classes/UtilityTelegram.php";
//
//$bitrix = My_InitializeBitrix();
//$bot = My_InitializeBot();
//$newConnection = new mysqli(
//    'localhost',
//    'root',
//    null,
//    'test'
//);
////$manualMode = true;
////$command = CommandList::UpdateUser;
////$chat_id = 985114939;
////$messageText = mb_convert_encoding('Обновить информацию обо мне', "UTF-8");
////$result = ["message" => ["text" => $messageText, "chat" => ["id" => $chat_id]]];
////
////
////require_once "classes/Reporting.php";
//
//print_r(My_InitializeReportingBot()->getWebhookInfo());
//
//// $result = My_FindBitrixUser($bitrix, ["PHONE" => "+79963200144"]);
//// print_r($result);
//// echo('<p></p><p></p>');


