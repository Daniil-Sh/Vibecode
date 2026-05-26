<?php
require_once __DIR__.'/classes/workEnv/readEnv.php';
require_once __DIR__.'/classes/workEnv/editEnv.php';
require_once __DIR__.'/classes/requests/request.php';

$message = '';

$configFile = ".env";
$knownKeys = readConfig($configFile);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && array_key_exists("save", $_POST)) {
    $newConfig = [];
    foreach ($knownKeys as $key => $value) {
        if (isset($_POST[$key])) {
            $newConfig[$key] = $_POST[$key];
        }
    }
    // Запись в файл
    if (writeConfig($configFile, $newConfig, $knownKeys)) {
        $message = '<div style="color: green;">Конфигурация успешно сохранена.</div>';
        $knownKeys = readConfig($configFile);
    } else {
        $message = '<div style="color: red;">Ошибка записи файла. Проверьте права на запись.</div>';
    }
}

$FieldID = readEnvKey("SMARTPROCESS_FIELD");
$SPID = readEnvKey("SMARTPROCESS_ID");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && array_key_exists("getFields", $_POST)) {
    $SPID = readEnvKey("SMARTPROCESS_ID");
    $requestResult = sendRequest('https://vibecode.bitrix24.tech/v1/smart-processes/' . $SPID);
    if($requestResult["httpCode"] == "200") $getFieldsResult = json_decode($requestResult["response"], true)["data"];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && array_key_exists("getUserFields", $_POST)) {
    $SPID = readEnvKey("SMARTPROCESS_ID");
    $requestResult = sendRequest('https://vibecode.bitrix24.tech/v1/items/' . $SPID . '/fields');
    if($requestResult["httpCode"] == "200") $getFieldsResult = json_decode($requestResult["response"], true)["data"];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && array_key_exists("SetUserField", $_POST)) {
    $requestResult = sendRequest('https://vibecode.bitrix24.tech/v1/items/' . $SPID . '/' . $_POST["ItemID"], [], json_encode([$FieldID => $_POST["FiledValue"]]), 'PATCH');
    $editMessage = $requestResult["httpCode"] == "200" ? "Успешно" : "Неудачно";
    $filledValue = html_entity_decode($_POST["FiledValue"], ENT_NOQUOTES, 'UTF-16');
}

?>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактор конфигурации</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Редактирование параметров</h1>
    <?= $message ?>
    <form method="post">
        <?php foreach ($knownKeys as $key => $value): ?>
            <div class="form-group">
                <label for="<?= $key ?>"><?= htmlspecialchars($key) ?></label>
                <input type="<?= $key[0] == "!" ? "password" : "text" ?>" id="<?= $key ?>" name="<?= $key ?>" value="<?= htmlspecialchars($value ?? '') ?>">
            </div>
        <?php endforeach; ?>
        <button type="submit" name="save">Сохранить</button>
    </form>
    <form method="post">
        <?php if (isset($getFieldsResult)) {
            foreach ($getFieldsResult as $key => $value): ?>
                <div class="form-group">
                    <label for="<?= $key ?>"><?= htmlspecialchars($key) ?></label>
                    <input disabled type="text" id="<?= $key ?>" name="<?= $key ?>" value="<?= htmlspecialchars($value ?? '') ?>">
                </div>
            <?php endforeach;
        } ?>
        <button type="submit" name="getFields">Получить поля</button>
    </form>
    <form method="post">
        <?php if (isset($getFieldsResult)) {
            foreach ($getFieldsResult as $key => $value): ?>
                <div class="form-group">
                    <label for="<?= $key ?>"><?= htmlspecialchars($key) ?></label>
                    <input disabled type="text" id="<?= $key ?>" name="<?= $key ?>" value="<?= htmlspecialchars($value ?? '') ?>">
                </div>
            <?php endforeach;
        } ?>
        <button type="submit" name="getUserFields">Получить пользовательские поля</button>
    </form>
    <form method="post">
        <?=$editMessage ?>
        <div class="form-group">
            <label for="ItemID">ID Элемента смарт-процесса</label>
            <input type="number" id="ItemID" name="ItemID" value="<?= $_POST["ItemID"] ?>">
        </div>
        <div class="form-group">
            <label for="FiledValue">Значение поля</label>
            <?php echo('<input type="text" id="FiledValue" name="FiledValue" value=\'' . $filledValue . '\'>');?>
        </div>
        <button type="submit" name="SetUserField">Изменить поле</button>
    </form>
</body>
</html>


