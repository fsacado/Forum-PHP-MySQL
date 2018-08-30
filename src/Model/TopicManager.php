<?php

namespace Loann\Model;

use Loann\Model\Manager;

class TopicManager extends Manager
{

    const TABLE = 'Topic';
    const CLASSREF = Topic::class;

    /**
     * @return array
     */
    public function findAll()
    {
        $req = "SELECT * FROM " . self::TABLE;
        $statement = $this->pdo->query($req);
        return $statement->fetchAll(\PDO::FETCH_CLASS, self::CLASSREF);
    }

    public function findAuthorByTopic($title)
    {
        $req = "SELECT User.username FROM User
                INNER JOIN " . self::TABLE . "
                ON Topic.author_id = User.id
                WHERE Topic.title=:title ";
        
        $statement = $this->pdo->prepare($req);
        $statement->bindParam(":title", $title);
        $statement->execute();

        return $statement->fetch(\PDO::FETCH_COLUMN, 0);
    }

}
