<?php
require_once "../model/user.class.php";
require_once "../database_dao/UserDAO.php";

class UserController
{
    /** @var array Defines the columns names for the user table */
    private const USER_COLUMNS = [
        "id",
        "nome",
        "login",
        "idade",
        "sexo",
        "email",
        "senha"
    ];

    public function __construct()
    {
    }

    /**
     * Searches for all the columns of the user table
     *
     * @param $id User id to be found in the database
     * @return User data in the database
     */
    public static function findUserById($id)
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

    /**
     * Searches for all the users in the database
     * @return array With all the users columns
     */
    public static function findAllUsers()
    {
        $userDao = new UserDAO();

        $query = "SELECT * FROM usuarios";

        $result = $userDao->select($query);

        foreach ($result as $userData){

            if ($userData) {
                $users[] = new User($userData);
            }
        }

        return $users;
    }

    /**
     * Makes a custom search
     * @param $options array Expects an array with the options of the search,
     * the columns to be searched
     * and the filters to be used
     * @return array
     */
    public static function search($options)
    {
        $userDao = new UserDAO();
        $query = self::formatQuery($options);
        return $userDao->select($query);
    }

    /**
     * @param $login
     * @param $password
     * @return bool
     */
    public function doLogin($login, $password)
    {
        $userDao = new UserDAO();

        $options = [
            'where' => [
                'login' => $login,
                'senha' => $password
            ]
        ];

        $query = self::formatQuery($options);

        return $userDao->select($query) ? true : false;
    }

    /**
     * Formats an query to be searched in the database
     * @param $options array $options['columns'] and $options['where']
     * @return bool|string
     */
    private function formatQuery($options)
    {
        $query = "SELECT ";

        if (isset($options['columns']) && count($options['columns']) > 0) {
            $iterator = 1;

            foreach ($options['columns'] as $index => $column) {
                if (in_array($column, self::USER_COLUMNS)) {
                    if ($iterator == 1) {
                        $query .= "{$column}";
                    } elseif ($index == array_key_last($options['columns'])) {
                        $query .= ", {$column} ";
                    } else {
                        $query .= ", {$column},";
                    }
                    $iterator = 2;
                }
            }
        } else {
            $query .= "* ";
        }

        $iterator = 1;
        $query .= "FROM usuarios ";

        foreach ($options['where'] as $columnName => $searchValue) {
            if (in_array($columnName, self::USER_COLUMNS)) {
                if ($iterator == 1) {
                    $query .= "WHERE {$columnName} = '{$searchValue}' ";
                } else {
                    $query .= " AND {$columnName} = '{$searchValue}'";
                }
                $iterator = 2;
            }
        }
        return $query;
    }
}