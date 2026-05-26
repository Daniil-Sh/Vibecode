<?php
function writeConfig($file, $newValues, $knownKeys) {

    $success = false;

    if (!file_exists($file)) {
        $originalLines = [];
    } else {
        $originalLines = file($file, FILE_IGNORE_NEW_LINES);
    }
    $output = [];
    $keysUpdated = [];

    // Проходим по оригинальным строкам и обновляем значения
    foreach ($originalLines as $line) {
        $lineTrim = trim($line);
        if (strpos($lineTrim, '=') !== false) {
            list($key, ) = explode('=', $lineTrim, 2);
            $key = trim($key);
            
            if (array_key_exists($key, $knownKeys) && array_key_exists($key, $newValues)) {
                // Заменяем значение
                $output[] = $key . '=' . $newValues[$key];
                $keysUpdated[] = $key;
                $success = true;
                continue;
            }
        }
        $output[] = $line;
    }

    // Добавляем новые переменные, которые не были найдены в файле
    foreach ($newValues as $key => $value) {
        if (!in_array($key, $keysUpdated) && in_array($key, $knownKeys)) {
            $output[] = $key . '=' . $value;
        }
    }

    // Записываем обратно в файл
    file_put_contents($file, implode(PHP_EOL, $output));

    return $success;
}