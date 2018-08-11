<?php

namespace Loann\Model;

abstract class Manager
{
    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * DeclinationManager constructor.
     */
    public function __construct()
    {
        $this->pdo = new \PDO(DSN, USER, PASS);
        // activate error for pdo requests
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $this->pdo->exec("SET NAMES 'utf8';");
    }
}