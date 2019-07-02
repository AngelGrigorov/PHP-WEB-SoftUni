<?php

namespace App\Repository\Books;


use App\Data\BookDTO;

interface BookRepositoryInterface
{
    public function insert(BookDTO $bookDTO): bool;
    public function update(BookDTO $bookDTO, int $id): bool;
    public function remove(int $id) : bool;

    /**
     * @return \Generator|BookDTO[]
     */
    public function findAll(): \Generator;

    public function findOneById(int $id) : BookDTO;

    /**
     * @param int $id
     * @return \Generator|BookDTO[]
     */
    public function findAllByAuthorId(int $id) : \Generator;
}