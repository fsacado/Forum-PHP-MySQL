<?php

namespace Loann\Model;

class User
{
    /*
     * @var int
     */
    private $id;

    /*
     * @var string
     */
    private $username;

    /*
     * @var string
     */
    private $firstname;

    /*
     * @var string
     */
    private $lastname;

    /*
     * @var string
     */
    private $role;

    /**
     * @param mixed $id
     * @return Category
     */
    public function getId()
    {
        return $this->id;
    }

    /*
     * @return mixed
     */
    public function getUsername()
    {
        return $this->usernname;
    }

    /**
     * @param mixed $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /*
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /*
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /*
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     * @return User
     */
    public function setRole($role = 'user')
    {
        $this->role = $role;
        return $this;
    }
}
