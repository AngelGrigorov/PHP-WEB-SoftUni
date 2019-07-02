<?php

namespace App\Service\Genres;


use App\Data\GenreDTO;
use App\Repository\Genres\GenreRepositoryInterface;

class GenreService implements GenreServiceInterface
{
    /**
     * @var GenreRepositoryInterface
     */
    private $genreRepository;

    public function __construct(GenreRepositoryInterface $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    /**
     * @return \Generator|GenreDTO[]
     */
    public function getAll(): \Generator
    {
        return $this->genreRepository->findAll();
    }

    public function getOneById(int $id): GenreDTO
    {
        return $this->genreRepository->findOneById($id);
    }
}