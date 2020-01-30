<?php

require_once "../database_dao/UserDAO.php";
use PHPUnit\Framework\TestCase;
class testConnection extends TestCase
{
    /**
     * Tests if the database connection is working properly
     * @test
     */
    public function givenNewObjectWhenInstancesItThenConstructs(){
        $this->assertIsObject(new UserDAO());
    }

    /**
     * Tests if the database search is working properly
     * @test
     */
    public function givenSelectQueryWhenSearchsInDatabaseTheReturnsAValue(){
        $users = new UserDAO();
        $query = "SELECT * FROM usuarios WHERE id = 1";
        $expected[] = [
            "id" => 1,
            "nome" => "Marianes",
            "login" => "marimar",
            "idade" => 20,
            "sexo" => "fem",
            "email" => "email@mariana.com",
            "senha" => "123456"
        ];

        $this->assertEquals($expected, $users->select($query));
    }
}
