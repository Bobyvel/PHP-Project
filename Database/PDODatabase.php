<?php

namespace Database;


class PDODatabase implements DatabaseInterface
{

    private $pdo;

  public function __construct(\PDO $pdo)
  {
      $this->pdo = $pdo;
  }

    public function query(string $query): PrepredStatementInterface
    {
        $stm = $this->pdo->prepare($query);
        return new PDOPreparedStatement($stm);
    }

    public function getLastError() : array
    {
        return $this->pdo->errorInfo();
    }

    public function getLastId() : int
    {
       return $this->pdo->lastInsertId();
    }
}