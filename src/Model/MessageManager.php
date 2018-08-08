<?php

namespace Loann\Model;

use Loann\Model\Manager;

class MessageManager extends Manager
{
    const TABLE = 'Message';
    const CLASSREF = Message::class;

    public function findMessageNumberPerCategory($category_name)
    {
        $req = "SELECT COUNT(*) FROM " . self::TABLE . "
                INNER JOIN Topic ON Topic.id = " . self::TABLE . ".topic_id 
                INNER JOIN Subclass ON Topic.subclass_id=Subclass.id 
                INNER JOIN Category ON Subclass.category_id=Category.id 
                WHERE Category.name=:name";
        // $statement = $this->pdo->query($req);
        $statement = $this->pdo->prepare($req);
        // $statement->execute([':name' => 'Hardware']);
        $statement->bindParam(':name', $category_name);
        $statement->execute();

        return $statement->fetch(\PDO::FETCH_COLUMN, 0); // returns only the count value
    }

    public function findLastAddedMessagePerCategory($category_name)
    {
        $req = "SELECT " . self::TABLE . ".publication_date FROM " . self::TABLE . "
                INNER JOIN Topic ON Topic.id=" . self::TABLE . ".topic_id 
                INNER JOIN Subclass ON Subclass.id=Topic.subclass_id 
                INNER JOIN Category ON Category.id=Subclass.category_id 
                WHERE Category.name=:name 
                ORDER BY " . self::TABLE . ".publication_date DESC 
                LIMIT 1";
        
        $statement = $this->pdo->prepare($req);
        $statement->bindParam(':name', $category_name);
        $statement->execute();
    
        return $statement->fetch(\PDO::FETCH_COLUMN, 0);

    }
}
