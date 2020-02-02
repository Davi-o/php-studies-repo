<?php
require_once "../model/user.class.php";
require_once "../database_dao/UserDAO.php";

class UserController
{
    /** @var array Defines the columns names for the user table */
    private const USER_COLUMNS = [
        "id",
        "max(id)",
        "nome",
        "login",
        "idade",
        "sexo",
        "email",
        "senha"
    ];

    /** @var array Defines the basics commands for the queries */
    private const SQL_DML_COMMANDS = [
        'UPDATE',
        'DELETE'
    ];

    public function __construct()
    {
    }

    /**
     * @param $options
     */
    public function updateUser($options)
    {
        $userDao = new UserDAO();
        $options+=['type'=> 'update'];
        $query = self::formatQuery($options);
        $userDao->query($query);
    }

    /**
     * @param $options
     */
    public function deleteUser($options)
    {
        $userDao = new UserDAO();
        $options+=['type'=> 'delete'];
        $query = self::formatQuery($options);
        $userDao->query($query);
    }

    /**
     * @param $userData array
     * @return array Returns the last inserted row int the database
     */
    public function createNewUser(array $userData)
    {
        $user = new User($userData);

        $query = "CALL sp_usuarios_insert(:NAME, :LOGIN, :AGE, :SEX, :MAIL, :PASSWORD)";

        $userDao = new UserDAO();
        $result = $userDao->select
        (
            $query,
            [
                ':NAME' => $user->getName(),
                ':LOGIN' => $user->getLogin(),
                ':AGE' => $user->getAge(),
                ':SEX' => $user->getSex(),
                ':MAIL' => $user->getMail(),
                ':PASSWORD' => $user->getPassword()
            ]
        );

        foreach ($result as $newUser){

            if ($newUser) {
                $users[] = new User($newUser);
            }
        }

        return $users;
    }

    /**
     * Searches for all the columns of the user table
     *
     * @param $id integer id to be found in the database
     * @return User data in the database
     */
    public static function findUserById(int $id)
    {
        $userDao = new UserDAO();

        $query = [
            'where' => [
                'id' => $id
            ]
        ];
        $query = self::formatQuery($query);

        $result = $userDao->select($query);

        foreach ($result as $userData){

            if ($userData) {
                $user = new User($userData);
            }
        }

        return $user;
    }

    /**
     * Makes a custom search
     * @param $options array Expects an array with the options of the search,
     * the columns to be searched
     * and the filters to be used
     * @return array
     */
    public static function search(array $options)
    {
        $userDao = new UserDAO();
        $query = self::formatQuery($options);

        $result = $userDao->select($query);

        foreach ($result as $userData){

            if ($userData) {
                $user[] = new User($userData);
            }
        }
        return $user;
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
    private function formatQuery(array $options)
    {
        $query = 'SELECT ';

        if (
            isset($options['type'])
            && in_array(
                $options['type'],
                array_map("strtolower",self::SQL_DML_COMMANDS)
            )
        ) {
            switch ($options['type']){
                case $options['type'] == "delete" && isset($options['where']):
                    $query = 'DELETE FROM usuarios ';
                    break;
                case $options['type'] == 'update':
                    $query = 'UPDATE usuarios SET ';
                    break;
                default:
                    break;
            }
        }

        if (isset($options['columns']) && count($options['columns']) > 0) {
            $iterator = 1;

            foreach ($options['columns'] as $columnName => $columnValue) {
                if (in_array($columnName, self::USER_COLUMNS)) {
                    if ($iterator == 1) {
                        $query .= ($options['type'] == 'update') ? "{$columnName} = '{$columnValue}'" : "{$columnName}";

                    } elseif ($columnName == array_key_last($options['columns'])) {
                        $query .= ($options['type'] == 'update') ? ", {$columnName} = '{$columnValue}' " : ", {$columnName} ";

                    } else {
                        $query .= ($options['type'] == 'update') ? ", {$columnName} = '{$columnValue}'" : ", {$columnName},";

                    }
                    $iterator = 2;
                }
            }
        } else {
            $query .= "* ";
        }

        $iterator = 1;
        $query .= isset($options['type']) ? '' : " FROM usuarios ";

        if (isset($options['where'])) {
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
        }

        return $query;
    }
}