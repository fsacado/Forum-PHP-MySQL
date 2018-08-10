<?php

namespace Loann\Model;

use Loann\Model\Manager;

class SubclassManager extends Manager
{

    const TABLE = 'Subclass';
    const CLASSREF = Subclass::class;

    /**
     * @return array
     */
    public function findAll()
    {
        $req = "SELECT * FROM " . self::TABLE;
        $statement = $this->pdo->query($req);
        return $statement->fetchAll(\PDO::FETCH_CLASS, self::CLASSREF);
    }

    public function findByCategory($category_name)
    {
        $req = "SELECT " . self::TABLE . ".name FROM " . self::TABLE . "
                INNER JOIN Category
                ON Category.id = " . self::TABLE . ".category_id
                WHERE Category.name = :name
                ORDER BY " . self::TABLE . ".name";

        $statement = $this->pdo->prepare($req);
        $statement->bindParam(':name', $category_name);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

}
