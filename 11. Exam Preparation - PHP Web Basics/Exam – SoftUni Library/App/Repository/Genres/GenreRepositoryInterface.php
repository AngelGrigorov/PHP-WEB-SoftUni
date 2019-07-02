<?php

namespace App\Repository\Genres;


use App\Data\GenreDTO;

interface GenreRepositoryInterface
{
    /**
     * @return \Generator|GenreDTO[]
     */
    public function findAll() : \Generator;

    public function findOneById(int $id): GenreDTO;
}