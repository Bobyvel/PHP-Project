<?php

namespace Database;


use App\DTO\UserDTO;

class ResultSet implements ResultSetInterface
{
    private $pdoStatement;

    public function __construct(\PDOStatement $PDOStatement)
    {
        $this->pdoStatement = $PDOStatement;
    }

    public function fetchAll(?string $className = null): \Generator
    {
        while ($row = $this->pdoStatement->fetchObject($className)){
            yield $row;
        }
    }

    public function getOne($className)    {
        return $this->pdoStatement->fetchObject($className);
    }
}