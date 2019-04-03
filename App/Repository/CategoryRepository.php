<?php


namespace App\Repository;


use Database\PDODatabase;
use App\DTO\GenreDTO;

class CategoryRepository
{
    /**
     * @var PDODatabase
     */
    private $db;

    /**
     * CategoryRepository constructor.
     * @param PDODatabase $db
     */
    public function __construct(PDODatabase $db)
    {
        $this->db = $db;
    }

    /**
     * @return \Generator|GenreDTO\[]
     */
    public function findAll(): \Generator
    {
       return $this->db->query("
            SELECT genre_id, name
            FROM genres
        ")->execute()
            ->fetchAll(GenreDTO::class);
    }

    public function findOne(int $id): GenreDTO
    {

        return $this->db->query("
            SELECT genre_id, name
            FROM genres
            WHERE genre_id = ?
        ")->execute([$id])
            ->fetchAll(GenreDTO::class)
            ->current();
    }
}