﻿<?php
$uploaddir = './upload/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "Файл корректен и был успешно загружен.\n";
} else {
    echo "Возможная атака с помощью файловой загрузки!\n";
}
echo $uploadfile;
echo 'Некоторая отладочная информация:';

print_r($_FILES);

print "</pre>";

?>