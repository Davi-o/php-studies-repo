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
     * Tests if User class can be instantiated with empty parameters
     * @test
     */
    public function givenNoParameterToUserClassConstructorWhenInstantiateItThenDontReturnError()
    {
        $this->assertIsObject(new User());
    }

    /**
     * Tests if the database search is working properly
     * @test
     */
    public function givenSelectQueryWhenSearchsInDatabaseThenReturnsExpectedValue()
    {
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

        $this->assertEquals($expectedUser, UserController::findUserById(1));
    }

    /**
     * Tests if the database search is working properly
     * @test
     */
    public function givenCallFunctionFindAllUsersWhenRunsItThenReturnsArray()
    {
        $this->assertIsArray(UserController::findAllUsers());
    }

    /**
     * Tests if the search occurs correctly
     */
    public function testFunctionUserControllerSearch()
    {
        $this->assertIsArray(
            UserController::search([
                'columns' => [
                    'id',
                    'nome',
                    'idade'
                ],
                'where' => [
                    'id' => 1,
                    'nome' => 'Marianes'
                ]
            ])
        );
    }

    /**
     * Tests if the login function is working
     */
    public function testDoLogin()
    {
        $userController = new UserController();
        $this->assertTrue($userController->doLogin('marimar', '123456'));
    }


}
