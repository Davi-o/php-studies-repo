<?php

try {
    $connection = new PDO("mysql:dbname=database_php7;host=localhost", "admin", "password");
    $connection->beginTransaction();

    $statement = $connection->prepare("DELETE FROM usuarios WHERE id = ?");

    $id = 3;

    $statement->execute([$id]);

    $connection->rollBack(); // cancela a transacao
//    $connection->commit(); // efetua a transacao

} catch (Exception $e){
    echo($e);
}

