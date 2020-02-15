<?php


class User
{
    private $id;
    private  $name;
    private $login;
    private $age;
    private $sex;
    private $mail;
    private $password;

    /**
     * User constructor.
     * @param null $userData Expects an array with all the data values of the user class
     */
    public function __construct($userData = null)
    {
        if ($userData) {
            $this->id = !isset($userData['id']) ?: $userData['id'];
            $this->name = !isset($userData['nome']) ?: $userData['nome'];
            $this->login = !isset($userData['login']) ?: $userData['login'];
            $this->age = !isset($userData['idade']) ?: $userData['idade'];
            $this->sex = !isset($userData['sexo']) ?: $userData['sexo'];
            $this->mail = !isset($userData['email']) ?: $userData['email'];
            $this->password = !isset($userData['senha']) ?: $userData['senha'];
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login): void
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age): void
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @param mixed $sex
     */
    public function setSex($sex): void
    {
        $this->sex = $sex;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail): void
    {
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

}