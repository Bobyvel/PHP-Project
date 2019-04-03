<?php

namespace App\Service;


use App\DTO\GenreDTO;
use App\Repository\CategoryRepository;

class CategoryService
{

    /**
     * @var CategoryRepository
     *
     */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return \Generator|GenreDTO[]
     */
    public function getAll(): \Generator
    {
        return $this->categoryRepository->findAll();
    }

    /**
     * @param int $id
     * @return GenreDTO
     * @throws \Exception
     */
    public function getOne(int $id): GenreDTO
    {
        $category = $this->categoryRepository->findOne($id);

        if($category === null){
            throw new \Exception("Genre not found!");
        }

        return $category;
    }
}