<?php
$path = "/home/odawi/Documentos/";
$imagesPath = $path."images";

if (! is_dir($imagesPath)) {
    mkdir($imagesPath, 0777);
}

for ($i = 0; $i < 10; $i++) {
    fopen($imagesPath.DIRECTORY_SEPARATOR."teste{$i}.txt", "w+");
}

foreach (scandir($imagesPath) as $item) {
    if (! in_array($item, [".",".."])) {
        unlink($imagesPath.DIRECTORY_SEPARATOR.$item);
    }
}

echo "Feitoria mestre";