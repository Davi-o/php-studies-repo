<form method="post" enctype="multipart/form-data">
    <input type="file" name="fileUpload">
    <button type="submit">Enviar</button>
</form>

<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $file = $_FILES["fileUpload"];

    if ($error = $file['error']) {
       throw new Exception("Erro:". $error);
    }

    $directory = "/home/odawi/Documentos/uploads";

    if (! is_dir($directory)) {
        mkdir($directory);
    }

    if (!move_uploaded_file($file["tmp_name"], $directory.DIRECTORY_SEPARATOR.$file["name"])) {
        throw new Exception("Erro ao realizar upload");
    }

    echo "Feito mestre";
}