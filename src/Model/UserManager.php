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

    public function findByUsername($username)
    {
        $req = "SELECT username FROM " . self::TABLE . "
                WHERE username LIKE BINARY :username"; // LIKE BINARY as for case sensitive

        $statement = $this->pdo->prepare($req);
        $statement->bindParam(':username', $username);
        $statement->execute();

        return $statement->fetch(\PDO::FETCH_COLUMN);
    }

    public function addNewUser($firstname, $lastname, $username, $password, $role = 'user')
    {
        $req = "INSERT INTO " . self::TABLE . "
                VALUES (NULL, :username, :firstname, :lastname, :role, :password)";

        $statement = $this->pdo->prepare($req);
        $statement->bindParam(':firstname', $firstname);
        $statement->bindParam(':lastname', $lastname);
        $statement->bindParam(':username', $username);
        $statement->bindParam(':password', $password);
        $statement->bindParam(':role', $role);

        return $statement->execute();
    }

    public function findPasswordByUsername($username)
    {
        $req = "SELECT password FROM " . self::TABLE . "
                WHERE username LIKE BINARY :username";

        $statement = $this->pdo->prepare($req);
        $statement->bindParam(':username', $username);
        $statement->execute();

        return $statement->fetch(\PDO::FETCH_COLUMN);
    }

}
