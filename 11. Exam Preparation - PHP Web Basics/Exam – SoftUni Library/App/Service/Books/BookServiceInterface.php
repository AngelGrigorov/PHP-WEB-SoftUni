<?php

namespace App\Service\Books;


use App\Data\BookDTO;

interface BookServiceInterface
{
    public function add(BookDTO $bookDTO) : bool;
    public function edit(BookDTO $bookDTO) : bool;
    public function delete(int $id) : bool;

    /**
     * @return \Generator|BookDTO[]
     */
    public function getAll() : \Generator;

    public function getOneById(int $id) : BookDTO;

    public function getAllByAuthor();
}