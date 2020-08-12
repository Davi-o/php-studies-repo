<?php

$url = "https://www.php.net/images/logos/php-logo.svg";

$content = file_get_contents($url);

$parse = parse_url($url);

$path = "/home/odawi/Documentos/uploads";

$fileName = basename($parse['path']);
$fileName = $path.DIRECTORY_SEPARATOR.$fileName;

$file = fopen($fileName, "w+");

fwrite($file, $content);

fclose($file);

echo "<img src=\"{$fileName}\">";



