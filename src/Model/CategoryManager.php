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

    public function findTopics($category_name)
    {
        $req = "SELECT Topic.title FROM Topic
                INNER JOIN Subclass ON Subclass.id=Topic.subclass_id
                INNER JOIN " . self::TABLE . " ON Category.id=Subclass.category_id
                WHERE Category.name=:category_name";

        $statement = $this->pdo->prepare($req);
        $statement->bindParam(':category_name', $category_name);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }
    
}