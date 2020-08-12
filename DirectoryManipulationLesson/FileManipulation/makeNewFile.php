<?php
$path = "/home/odawi/Documentos/log.txt";

$file = fopen($path, "a+");

fwrite($file, date('d-m-Y H:i:s') . "\r\n");

echo fread($file,filesize($path));

fclose($file);