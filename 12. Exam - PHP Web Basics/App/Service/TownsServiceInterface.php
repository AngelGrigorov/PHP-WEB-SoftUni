<?php

namespace App\Service;

use App\Data\TownDTO;

interface TownsServiceInterface
{

    /**
     * @return \Generator|TownDTO[]
     */
    public function getAll() : \Generator;
}
