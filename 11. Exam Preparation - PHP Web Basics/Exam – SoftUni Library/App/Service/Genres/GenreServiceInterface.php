<?php

namespace App\Service\Genres;


use App\Data\GenreDTO;

interface GenreServiceInterface
{
    /**
     * @return \Generator|GenreDTO[]
     */
    public function getAll(): \Generator;

    public function getOneById(int $id) : GenreDTO;
}