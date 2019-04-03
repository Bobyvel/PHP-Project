<?php

namespace Database;


use App\DTO\UserDTO;

interface ResultSetInterface
{
    public function fetchAll(?string $className = null): \Generator;
    public function getOne($className);
}