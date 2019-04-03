<?php

namespace App\Service;


use App\DTO\BookDTO;
use App\Repository\BookRepository;

class TaskService
{

    /**
     * @var BookRepository
     */
    private $task_repository;

    /**
     * TaskService constructor.
     * @param BookRepository $task_repository
     */
    public function __construct(BookRepository $task_repository)
    {
        $this->task_repository = $task_repository;
    }


    public function getList(){

        return $this->task_repository->getAll();
    }

    public function getMyList(int $user_id){

        return $this->task_repository->getMyAll($user_id);
    }

    public function getOneBook(int $book_id){

      return $this->task_repository->getOne($book_id);
    }

    public function add(BookDTO $bookDTO): bool
    {
      return $this->task_repository->insert($bookDTO);
    }

    /**
     * @param BookDTO $bookDTO
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function edit(BookDTO $bookDTO, int $id): bool
    {
        $book = $this->task_repository->getOne($id);

        if($book === null){
            throw new \Exception("Book not exist!");
        }

        return $this->task_repository->update($bookDTO, $id);
    }

    public function delete(int $task_id)
    {
       $this->task_repository->delete($task_id);
    }
}