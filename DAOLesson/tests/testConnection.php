<?php

require_once "../database_dao/UserDAO.php";
require_once "../model/user.class.php";
require_once "../controller/user_controller.php";

use PHPUnit\Framework\TestCase;
class testConnection extends TestCase
{
    /**
     * Tests if the database connection is working properly
     * @test
     */
    public function givenNewDABInstanceWhenInstantiateItThenConstructs()
    {
        $this->assertIsObject(new UserDAO());
    }

    /**
     * Tests if the database search is working properly
     * @test
     */
    public function givenSelectQueryWhenSearchsInDatabaseThenReturnsExpectedValue()
    {
        $userController = new UserController();

        $userData = [
            "id" => 1,
            "nome" => "Marianes",
            "login" => "marimar",
            "idade" => 20,
            "sexo" => "fem",
            "email" => "email@mariana.com",
            "senha" => "123456"
        ];

        $expectedUser = new User($userData);

        $this->assertEquals($expectedUser, $userController->findAllUserById(1));
    }

    /**
     * @test
     */
    public function givenNoParameterToUserClassConstructorWhenInstantiateItThenDontReturnError()
    {
        $this->assertIsObject(new User());
    }
}
