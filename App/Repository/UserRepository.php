<?php

namespace App\Repository;


use Database\PDODatabase;
use App\DTO\UserDTO;

class UserRepository
{
    /**
     * @var PDODatabase
     */
    private $db;

    /**
     * UserRepository constructor.
     * @param PDODatabase $db
     */
    public function __construct(PDODatabase $db)
    {
        $this->db = $db;
    }


    public function insertUser(UserDTO $userDTO): bool
    {
         $this->db->query("INSERT INTO users (username, password, full_name, born_on)
VALUES (:username, :password, :full_name, :born_on)")->execute([
            'username' => $userDTO->getUsername(),
            'password' => $userDTO->getPassword(),
            'full_name'=> $userDTO->getFullName(),
            'born_on'=> $userDTO->getBornON()
        ]);
        return true;
    }

    public function findUser(int $id): ?UserDTO
    {
        $result = $this->db->query("SELECT user_id, username, password, full_name AS fullName, born_on AS bornON FROM users WHERE user_id = :user_id")->execute(['user_id' => $id]);
        return $result->fetchAll(UserDTO::class)->current();
    }

    public function findUsername(string $username): ?UserDTO
    {
        $result = $this->db->query("SELECT user_id, username, password, full_name AS fullName, born_on AS bornON FROM users WHERE username = :username")->execute(['username' => $username]);
        return $result->fetchAll(UserDTO::class)->current();
    }
}