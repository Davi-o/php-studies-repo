<?php

$connection = new PDO("mysql:dbname=database_php7;host=localhost", "admin", "password");

 $statement = $connection->prepare("select * from usuarios");

 $statement->execute();
 $results = $statement->fetchAll(PDO::FETCH_ASSOC);

 foreach ($results as $column){
     foreach ($column as $columnName => $value){
         echo $columnName." => ". $value;
         echo "<br>";
     }
 }