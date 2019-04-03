<?php

namespace Database;


interface PrepredStatementInterface
{
public function execute(array $params = []):ResultSetInterface;
}