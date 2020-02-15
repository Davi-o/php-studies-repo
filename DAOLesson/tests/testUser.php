<?php

require_once "../database_dao/UserDAO.php";
require_once "../model/user.class.php";
require_once "../controller/user_controller.php";

use PHPUnit\Framework\TestCase;
class testUser extends TestCase
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
    public function givenSelectQueryWhenRunsFindUserByIdThenReturnsExpectedValue()
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
        $this->assertIsArray(UserController::search([]));
    }

    /**
     * Tests if the search occurs correctly
     * @test
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
     * @test
     */
    public function testDoLogin()
    {
        $userController = new UserController();
        $this->assertTrue($userController->doLogin('marimar', '123456'));
    }

    /**
     * Tests if the method CreateNewUser works properly
     * @test
     */
    public function testCreateNewUser()
    {
        $userData = [
            "nome" => "Marcelinho Vidal",
            "login" => "vidal",
            "idade" => '20',
            "sexo" => "mas",
            "email" => "vidal@mail.com",
            "senha" => "1641"
        ];

        $newId = UserController::search(
            [
                'columns' => [
                    'max(id) as id'
                ]
            ]
        );

        $newId = $newId[0]->getId() + 1;

        $expectedUser[] = new User(
            $userData += [
                'id' => $newId
            ]
        );

        $userController = new UserController();

        $this->assertEquals($expectedUser, $userController->createNewUser($userData));
    }

    /**
     * Tests if the update method works properly
     * @test
     */
    public function testUpdateUser()
    {
        $userData = [
            'id' => 10,
            'nome' => 'Pedro',
            'login' => 'pedrini',
            'idade' => 15,
            "sexo" => "mas",
            "email" => "pedron@mail.com",
            'senha' => '12345x'
        ];

        $expectedUser = new User($userData);

        $options = [
            'columns' => [
                'nome' => 'Pedro',
                'login' => 'pedrini',
                'senha' => '12345x',
                'idade' => 15,
                'email' => 'pedron@mail.com'
            ],
            'where' => [
                'id' => 10
            ]
        ];

        $userController = new UserController();
        $userController->updateUser($options);

        $this->assertEquals($expectedUser, UserController::findUserById(10));
    }

    /**
     * Tests if the delete method works properly
     * @test
     */
    public function givenLastUserIdWhenDeletesThenReturnsNull()
    {
        $lastId = UserController::search(
            [
                'columns' => [
                    'max(id) as id'
                ]
            ]
        );

        $options = [
            'where' => [
                'id' => $lastId[0]->getId()
            ]
        ];

        $userController = new UserController();
        $userController->deleteUser($options);

        $this->assertNull(UserController::findUserById(14));
    }

}
