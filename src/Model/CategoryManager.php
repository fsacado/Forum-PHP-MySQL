<?php

namespace Loann\Model;

use Loann\Model\Manager;

class CategoryManager extends Manager
{

    const TABLE = 'Category';
    const CLASSREF = Category::class;
    
    /**
     * @return array
     */
    public function findAll()
    {
        $req = "SELECT * FROM " . self::TABLE;
        $statement = $this->pdo->query($req);
        return $statement->fetchAll(\PDO::FETCH_CLASS, self::CLASSREF);
    }

}