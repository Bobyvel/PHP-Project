<?php

namespace Database;

interface DatabaseInterface{
    public function query(string $query): PrepredStatementInterface;
    public function getLastError();
    public function getLastId();

}