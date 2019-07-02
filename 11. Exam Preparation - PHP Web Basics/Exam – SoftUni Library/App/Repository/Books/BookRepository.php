<?php

namespace App\Repository\Books;


use App\Data\BookDTO;
use App\Data\GenreDTO;
use App\Data\UserDTO;
use App\Repository\DatabaseAbstract;

class BookRepository extends DatabaseAbstract implements BookRepositoryInterface
{

    public function insert(BookDTO $bookDTO): bool
    {
        $this->db->query(
            "
                 INSERT INTO books(
                      title, 
                      author, 
                      description, 
                      image_url, 
                      genre_id, 
                      user_id)
                  VALUES (?,?,?,?,?,?)
            ")->execute([
            $bookDTO->getTitle(),
            $bookDTO->getAuthor(),
            $bookDTO->getDescription(),
            $bookDTO->getImageURL(),
            $bookDTO->getGenre()->getId(),
            $bookDTO->getUser()->getId()
        ]);

        return true;
    }

    public function update(BookDTO $bookDTO, int $id): bool
    {
        $this->db->query(
            "
                 UPDATE books
                 SET
                      title = ?, 
                      author = ?, 
                      description = ?, 
                      image_url = ?, 
                      genre_id = ?, 
                      user_id = ?
                 WHERE id = ?
            ")->execute([
            $bookDTO->getTitle(),
            $bookDTO->getAuthor(),
            $bookDTO->getDescription(),
            $bookDTO->getImageURL(),
            $bookDTO->getGenre()->getId(),
            $bookDTO->getUser()->getId(),
            $id
        ]);

        return true;
    }

    public function remove(int $id): bool
    {
        $this->db->
        query("DELETE FROM books WHERE id = ?")
            ->execute([$id]);
        return true;
    }

    /**
     * @return \Generator|BookDTO[]
     */
    public function findAll(): \Generator
    {
        $lazyBookResult = $this->db->query(
            "
                  SELECT 
                      b.id as bookId,
                      b.title,
                      b.author,
                      b.description,
                      b.image_url as imageURL,
                      b.added_on,
                      b.genre_id,
                      b.user_id,
                      g.id as genreId,
                      g.name,
                      u.id as userId,
                      u.username,
                      u.password,
                      u.full_name,
                      u.born_on
                  FROM books as b
                  INNER JOIN genres as g on b.genre_id = g.id
                  INNER JOIN users as u on b.user_id = u.id
                  ORDER BY b.added_on DESC
            ")->execute()
            ->fetchAssoc();

        foreach ($lazyBookResult as $row) {

            /** @var BookDTO $book */
            /** @var UserDTO $user */
            /** @var GenreDTO $genre */
            $book = $this->dataBinder->bind($row, BookDTO::class);
            $genre = $this->dataBinder->bind($row, GenreDTO::class);
            $user = $this->dataBinder->bind($row, UserDTO::class);
            $book->setId($row['bookId']);
            $genre->setId($row['genreId']);
            $user->setId($row['userId']);
            $book->setGenre($genre);
            $book->setUser($user);

            yield $book;
        }
    }

    public function findOneById(int $id): BookDTO
    {
        $row = $this->db->query(
            "
                  SELECT 
                      b.id as bookId,
                      b.title,
                      b.author,
                      b.description,
                      b.image_url as imageURL,
                      b.added_on,
                      b.genre_id,
                      b.user_id,
                      g.id as genreId,
                      g.name,
                      u.id as userId,
                      u.username,
                      u.password,
                      u.full_name,
                      u.born_on
                  FROM books as b
                  INNER JOIN genres as g on b.genre_id = g.id
                  INNER JOIN users as u on b.user_id = u.id
                  WHERE b.id = ?
                  ORDER BY b.added_on DESC
            ")->execute([$id])
                ->fetchAssoc()
            ->current();

        /** @var BookDTO $book */
        /** @var UserDTO $user */
        /** @var GenreDTO $genre */
        $book = $this->dataBinder->bind($row, BookDTO::class);
        $genre = $this->dataBinder->bind($row, GenreDTO::class);
        $user = $this->dataBinder->bind($row, UserDTO::class);
        $book->setId($row['bookId']);
        $genre->setId($row['genreId']);
        $user->setId($row['userId']);
        $book->setGenre($genre);
        $book->setUser($user);

        return $book;
    }

    /**
     * @param int $id
     * @return \Generator|BookDTO[]
     */
    public function findAllByAuthorId(int $id): \Generator
    {
        $lazyBookResult = $this->db->query(
            "
                  SELECT 
                      b.id as bookId,
                      b.title,
                      b.author,
                      b.description,
                      b.image_url as imageURL,
                      b.added_on,
                      b.genre_id,
                      b.user_id,
                      g.id as genreId,
                      g.name,
                      u.id as userId,
                      u.username,
                      u.password,
                      u.full_name,
                      u.born_on
                  FROM books as b
                  INNER JOIN genres as g on b.genre_id = g.id
                  INNER JOIN users as u on b.user_id = u.id
                  WHERE b.user_id = ?
                  ORDER BY b.added_on DESC
            ")->execute([$id])
            ->fetchAssoc();

        foreach ($lazyBookResult as $row) {

            /** @var BookDTO $book */
            /** @var UserDTO $user */
            /** @var GenreDTO $genre */
            $book = $this->dataBinder->bind($row, BookDTO::class);
            $genre = $this->dataBinder->bind($row, GenreDTO::class);
            $user = $this->dataBinder->bind($row, UserDTO::class);
            $book->setId($row['bookId']);
            $genre->setId($row['genreId']);
            $user->setId($row['userId']);
            $book->setGenre($genre);
            $book->setUser($user);

            yield $book;
        }

    }
}