<?php

namespace App\Service;


use App\Data\TownDTO;
use App\Repository\TownRepositoryInterface;

class TownsService implements TownsServiceInterface
{
    /**
     * @var TownRepositoryInterface
     */
    private $categoryRepository;

    public function __construct(TownRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }


    /**
     * @return \Generator|TownDTO[]
     */
    public function getAll(): \Generator
    {
        return $this->categoryRepository->findAll();
    }
}
