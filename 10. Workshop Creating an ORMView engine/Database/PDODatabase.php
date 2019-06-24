<?php

namespace Database;


class PDODatabase implements DatabaseInterface
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * PDODatabase constructor.
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    public function query(string $query): PreparedStatementInterface
    {
        $stm = $this->pdo->prepare($query);

        return new PDOPreparedStatement($stm);
    }

    public function getLastError()
    {
        $last_err = $this->pdo->errorInfo();
        return $last_err;
    }

    public function getLastId()
    {
        $last_id = $this->pdo->lastInsertId();
        return $last_id;
    }
}