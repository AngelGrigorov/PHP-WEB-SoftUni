<?php

namespace App\Service;

use App\Data\CategoryDTO;

interface CategoryServiceInterface
{

    /**
     * @return \Generator|CategoryDTO[]
     */
    public function getAll() : \Generator;
}