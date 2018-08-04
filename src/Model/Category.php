<?php

namespace Loann\Model;

class Category
{
    /*
     * @var int
     */
    private $id;

    /*
     * @var string
     */
    private $nom;

    /**
     * @param mixed $id
     * @return Category
     */
    public function getId()
    {
        return $this->getId();
    }

    /* 
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     * @return Category
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }
}
