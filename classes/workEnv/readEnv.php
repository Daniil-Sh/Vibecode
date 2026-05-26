<?php
function readConfig($file = ".env") {
    $config = [];
    $lines = [];
    if (file_exists($file)) {
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }
    foreach ($lines as $line) {
        $lineTrim = trim($line);
        // Пропускаем комментарии и пустые строки при парсинге значений
        if (strpos($lineTrim, '#') === 0 || strpos($lineTrim, ';') === 0) {
            continue;
        }
        if (strpos($lineTrim, '=') !== false) {
            list($key, $value) = explode('=', $lineTrim, 2);
            $key = trim($key);
            // Сохраняем только известные ключи (или все, если $knownKeys пуст)
            if (empty($knownKeys) || in_array($key, $knownKeys)) {
                $config[$key] = $value;
            }
        }
    }
    return $config;
}

function readEnvKey($keyName) {
    $config = readConfig();
    foreach ($config as $key => $value) {
        if ($key == $keyName) {
            return $value;
        }
    }
    return null;
}