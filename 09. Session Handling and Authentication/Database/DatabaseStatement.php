<?php
namespace Database;

class DatabaseStatement implements DatabaseStatementInterface
{
    private $pdoStmt;

    /**
     * DatabaseStatement constructor.
     * @param $pdoStmt
     */
    public function __construct(\PDOStatement $pdoStmt)
    {
        $this->pdoStmt = $pdoStmt;
    }


    public function execute(array $params = []): DatabaseStatementInterface
    {
        $this->pdoStmt->execute($params);

        return $this;
    }

    public function fetch(): \Generator
    {
        $row = $this->pdoStmt->fetch(\PDO::FETCH_ASSOC);
        while (false !== $row) {
            yield $row;
            $row = $this->pdoStmt->fetch(\PDO::FETCH_ASSOC);
        }
    }
}