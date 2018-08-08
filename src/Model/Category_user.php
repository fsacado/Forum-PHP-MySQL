<?php

namespace Loann\Model;

class Category_user
{
    /*
     * @var int
     */
    private $id;

    /*
     * @var int
     */
    private $category_id;

    /*
     * @var int
     */
    private $user_id;

    /*
     * @var
     */
    private $user_role;

    /**
     * @param mixed $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $category_id
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * @param mixed $user_id
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_role
     */
    public function getUserRole()
    {
        return $this->user_role;
    }

    /**
     * @param mixed $user_role
     * @return Category_user
     */
    public function setUserRole($user_role)
    {
        $this->user_role = $user_role;
        return $this;
    }
}
