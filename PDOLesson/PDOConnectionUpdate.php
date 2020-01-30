<?php

try {
    $connection = new PDO("mysql:dbname=database_php7;host=localhost", "admin", "password");

    $statement = $connection->prepare(
        "update usuarios set 
                    nome = :NAME,
                    login = :LOGIN,
                    idade = :AGE,
                    sexo = :SEX,
                    email = :MAIL,
                    senha = :PASSWORD
                    where id = :ID"
    );

    $name = 'Daviel';
    $login = 'eldavi';
    $age = 20;
    $sex = 'mas';
    $mail = 'mara@mail';
    $password = '1234x6';
    $id = 3;

    $statement->bindParam(':NAME', $name,PDO::PARAM_STR);
    $statement->bindParam(':LOGIN', $login,PDO::PARAM_STR);
    $statement->bindParam(':AGE', $age, PDO::PARAM_INT);
    $statement->bindParam(':SEX', $sex,PDO::PARAM_STR);
    $statement->bindParam(':MAIL', $mail,PDO::PARAM_STR);
    $statement->bindParam(':PASSWORD', $password,PDO::PARAM_STR);
    $statement->bindParam(':ID', $id,PDO::PARAM_INT);
    $statement->execute();

} catch (Exception $e){
    echo($e);
}
