<?php
require_once "config.php";
use Client\Registry;
$register = new Registry();

$register->setName("Daniel Paladino");
$register->setEmail("mail@mail.com");
$register->setPassword("1234xyz");

echo($register->registerSale());