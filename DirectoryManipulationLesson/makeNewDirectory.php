<?php

$directoryName = "/home/odawi/Documentos/imagens";
$directoryJson = [];

if (!is_dir($directoryName)) {
    $success = mkdir($directoryName);
    if($success){
        echo "Diretorio $directoryName criado";
    } else {
        echo "Erro";
    }
} else {
    $directory = scandir($directoryName);
    foreach ($directory as $item) {
        $pathFile = $directoryName.$item;
        $fileInfo = pathinfo($pathFile);
        $fileInfo["modified"] = date("dmY H:i:s", filemtime($pathFile));
        array_push($directoryJson, $fileInfo);
    }
}

echo json_encode($directoryJson);