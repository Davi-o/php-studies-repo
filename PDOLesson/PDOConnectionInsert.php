<?php

try {
    $connection = new PDO("mysql:dbname=database_php7;host=localhost", "admin", "password");

    $statement = $connection->prepare("insert into usuarios(nome, login, idade, sexo, email, senha) values (:NAME, :LOGIN, :AGE, :SEX, :MAIL, :PASSWORD)");

    $name = 'Davi';
    $login = 'odavi';
    $age = 20;
    $sex = 'mas';
    $mail = 'mail@mail';
    $password = '12345x';

    $statement->bindParam(':NAME', $name,PDO::PARAM_STR);
    $statement->bindParam(':LOGIN', $login,PDO::PARAM_STR);
    $statement->bindParam(':AGE', $age, PDO::PARAM_INT);
    $statement->bindParam(':SEX', $sex,PDO::PARAM_STR);
    $statement->bindParam(':MAIL', $mail,PDO::PARAM_STR);
    $statement->bindParam(':PASSWORD', $password,PDO::PARAM_STR);
    $statement->execute();

} catch (Exception $e){
    echo($e);
}