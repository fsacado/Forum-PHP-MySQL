<?php

namespace Loann\Model;

use Loann\Model\Manager;

class UserManager extends Manager
{

    const TABLE = 'User';
    const CLASSREF = User::class;

    /**
     * @return array
     */
    public function findAll()
    {
        $req = "SELECT * FROM " . self::TABLE;
        $statement = $this->pdo->query($req);
        return $statement->fetchAll(\PDO::FETCH_CLASS, self::CLASSREF);
    }

    public function findModeratorsByCategory($category_name)
    {
        $req = "SELECT username FROM " . self::TABLE . "
                INNER JOIN Category_user
                ON User.id = Category_user.user_id
                INNER JOIN Category
                ON Category_user.category_id = Category.id
                WHERE Category_user.user_role='moderator'
                AND Category.name = :name";

        $statement = $this->pdo->prepare($req);
        $statement->bindParam(':name', $category_name);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);

    }

}
