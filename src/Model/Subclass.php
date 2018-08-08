<?php

namespace Loann\Model;

class Subclass
{
    /*
     * @var int
     */
    private $id;

    /*
     * @var string
     */
    private $name;

    /*
     * @var int
     */
    private $category_id;

    /**
     * @param mixed $id
     * @return Subclass
     */
    public function getId()
    {
        return $this->id;
    }

    /*
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Subclass
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param mixed $category_id
     * @return Subclass
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }
}
