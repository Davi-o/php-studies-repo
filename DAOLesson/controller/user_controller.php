<?php
require_once "../model/user.class.php";
require_once "../database_dao/UserDAO.php";

class UserController
{
    public function __construct()
    {
    }

    public function findAllUserById($id)
    {
        $userDao = new UserDAO();

        $query = "SELECT * FROM usuarios WHERE id = :ID";

        $result = $userDao->select($query, [
            ":ID" => $id
        ]);

        foreach ($result as $userData){

            if ($userData) {
                $user = new User($userData);
            }
        }

        return $user;
    }

}