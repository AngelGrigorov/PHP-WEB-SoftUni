<?php

namespace App\Service;

use App\Data\RoomDTO;

interface RoomsServiceInterface
{

    /**
     * @return \Generator|RoomDTO[]
     */
    public function getAll() : \Generator;
}
