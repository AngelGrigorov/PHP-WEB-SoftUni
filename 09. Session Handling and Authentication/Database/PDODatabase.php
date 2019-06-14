<?php
namespace Database;

class PDODatabase implements DatabaseInterface
{
    private $pdo;

    /**
     * PDODatabase constructor.
     * @param $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    public function query(string $query): DatabaseStatementInterface
    {
        return new DatabaseStatement($this->pdo->prepare($query));
    }

}