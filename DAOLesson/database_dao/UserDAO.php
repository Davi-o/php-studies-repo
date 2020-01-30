<?php

//namespace DatabaseDAO;

class UserDAO extends \PDO
{
    private $connection;

    public function __construct()
    {
        $this->connection = new PDO("mysql:host=localhost;dbname=database_php7", "admin", "password");
    }

    /**
     * Binds the query parameters
     * @param $statement
     * @param array $parameters
     */
    private function setParameters($statement, $parameters = [])
    {
        foreach ($parameters as $parameter => $value){
            $this->setParam($statement, $parameter, $value);
        }
    }

    /**
     * Binds one query parameter
     * @param $statement
     * @param $parameter
     * @param $value
     */
    private function setParam($statement, $parameter, $value)
    {
        $statement->bindParam($parameter, $value);
    }

    /**
     * Executes a query in the database
     * @param string $query
     * @param array $parameters
     * @return bool|false|PDOStatement
     */
    public function query($query, $parameters = [])
    {
        $statement = $this->connection->prepare($query);

        $this->setParameters($statement, $parameters);

        $statement->execute();

        return $statement;
    }

    /**
     * Does a search in the database, based on the qyery
     * @param string $query expects the rawSql
     * @param array $params expects the parameters to the query
     * @return array
     */
    public function select($query, $params = []) : array
    {
        $statement = $this->query($query, $params);
        return $statement->fetchAll(parent::FETCH_ASSOC);
    }
}