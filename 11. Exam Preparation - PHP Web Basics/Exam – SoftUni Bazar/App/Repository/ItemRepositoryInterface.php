<?php

namespace App\Repository;


use App\Data\EditItemDTO;
use App\Data\FullItemDTO;
use App\Data\ItemDTO;
use App\Data\MyItemDTO;

interface ItemRepositoryInterface
{
    public function add(ItemDTO $item);

    /**
     * @param int $userId
     * @return MyItemDTO[]\Generator
     */
    public function findByUserId(int $userId): \Generator;

    /**
     * @return FullItemDTO[]|\Generator
     */
    public function findAll(): \Generator;

    public function findOne(int $id): FullItemDTO;

    public function edit(EditItemDTO $item);

    public function delete(int $id);
}