<?php

try {
    $connection = new PDO("mysql:dbname=database_php7;host=localhost", "admin", "password");

    $statement = $connection->prepare("DELETE FROM usuarios WHERE id = :ID");
    $id = 3;

    $statement->bindParam(':ID', $id,PDO::PARAM_INT);
    $statement->execute();

} catch (Exception $e){
    echo($e);
}
