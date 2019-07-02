<?php

namespace App\Service;


use App\Data\EditItemDTO;
use App\Data\FullItemDTO;
use App\Data\ItemDTO;
use App\Data\MyItemDTO;

interface ItemServiceInterface
{
    public function create(ItemDTO $item);

    /**
     * @param int $userId
     * @return MyItemDTO[]|\Generator
     */
    public function getByUserId(int $userId): \Generator;

    /**
     * @return FullItemDTO[]|\Generator
     */
    public function getAll(): \Generator;

    public function getOne(int $id): FullItemDTO;

    public function edit(EditItemDTO $item, int $userId);

    public function delete(int $itemId, int $userId);

}