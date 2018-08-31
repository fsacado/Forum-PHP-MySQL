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

    public function findMessagesByTopic($title)
    {
        $req = "SELECT Message.content, Message.publication_date, User.username FROM Message
                INNER JOIN User ON User.id=Message.author_id 
                INNER JOIN ". self::TABLE . " ON " . self::TABLE . ".id=Message.topic_id 
                WHERE " . self::TABLE . ".title=:title
                ORDER BY Message.publication_date ASC";

        $statement = $this->pdo->prepare($req);
        $statement->bindParam(':title', $title);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

}
