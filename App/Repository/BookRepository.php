<?php

namespace App\Repository;

use Database\PDODatabase;
use App\DTO\GenreDTO;
use App\DTO\BookDTO;

class BookRepository{

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

    /**
     * @param int $user_id
     * @return \Generator|BookDTO[]
     */
    public function getAll() : \Generator{
        $stm = $this->db->query(
            ' SELECT
                book_id,
                title,
                author,
                description,
                image,
                users.user_id AS user_id,
                users.username AS username,
                genres.genre_id AS genre_id,
                genres.name,
                added_on
                
            FROM
                books
            INNER JOIN
                genres 
            ON books.genre_id = genres.genre_id
            INNER JOIN
              users
            ON books.user_id = users.user_id
            ORDER BY
                added_on DESC,
                books.book_id ASC
            ');

        $result = $stm->execute()->fetchAll(BookDTO::class);
        foreach ($result as $item){
            //var_dump($item);

            yield $item;
        }
    }


    public function getMyAll(int $user_id) : \Generator{

        $stm = $this->db->query(
            ' SELECT
                book_id,
                title,
                author,
                description,
                image,
                users.user_id AS user_id,
                users.username AS username,
                genres.genre_id AS genre_id,
                genres.name,
                added_on
                
            FROM
                books
            INNER JOIN
                genres 
            ON books.genre_id = genres.genre_id
            INNER JOIN
              users
            ON books.user_id = users.user_id
            WHERE books.user_id = :user_id
             ORDER BY
                added_on DESC,
                books.book_id ASC
                
            ');

        $result = $stm->execute(['user_id'=>$user_id])->fetchAll(BookDTO::class);

        foreach ($result as $item){

            yield $item;
        }
    }

    public function getOne(int $book_id) : BookDTO{
        $stm = $this->db->query(
            ' SELECT
                title,
                author,
                description,
                image,
                genres.genre_id AS genre_id,
                genres.name,
                added_on
                
            FROM
                books
            INNER JOIN
                genres 
            ON books.genre_id = genres.genre_id
            WHERE book_id = :book_id;
            
            
           
            ');

        return $stm->execute(['book_id'=>$book_id])->fetchAll(BookDTO::class)->current();



    }
    public function delete(int $book_id){
        $stm = $this->db->query('DELETE FROM books WHERE book_id = :book_id');
        $stm->execute(['book_id'=>$book_id]);
    }

    public function insert(BookDTO $bookDTO):bool {
       $this->db->query('INSERT INTO softuni_library.books 
          (title,author, description,image,genre_id,user_id)
            VALUE(:title,:author, :description,:image,:genre_id,:user_id)')->execute([
           'title'=>$bookDTO->getTitle(),
           'author'=>$bookDTO->getAuthor(),
           'description'=>$bookDTO->getDescription(),
           'image'=>$bookDTO->getImage(),
           'genre_id'=>$bookDTO->getGenreId(),
           'user_id'=>$bookDTO->getUserId()

        ]);
        return true;
    }

    public function update(BookDTO $bookDTO, int $id): bool
    {
        $this->db->query("
                UPDATE softuni_library.books
                SET 
                  title = :title,
                  author = :author,
                  description = :description,
                  image = :image,
                  genre_id = :genre_id,
                  user_id = :user_id
                 
              WHERE book_id = :book_id  
            ")->execute([
            'title'=>$bookDTO->getTitle(),
            'author'=>$bookDTO->getAuthor(),
            'description'=>$bookDTO->getDescription(),
            'image'=>$bookDTO->getImage(),
            'genre_id'=>$bookDTO->getGenreId(),
            'user_id'=>$bookDTO->getUserId(),
            'book_id' => $id
        ]);

        return true;
    }
}