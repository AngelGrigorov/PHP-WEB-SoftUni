<?php

namespace App\Service;


use App\Data\EditItemDTO;
use App\Data\FullItemDTO;
use App\Data\ItemDTO;
use App\Data\MyItemDTO;
use App\Repository\ItemRepositoryInterface;

class ItemService implements ItemServiceInterface
{
    /**
     * @var ItemRepositoryInterface
     */
    private $itemRepository;

    /**
     * ItemService constructor.
     * @param ItemRepositoryInterface $itemRepository
     */
    public function __construct(ItemRepositoryInterface $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }


    public function create(ItemDTO $item)
    {
        $this->itemRepository->add($item);
    }

    /**
     * @param int $userId
     * @return MyItemDTO[]|\Generator
     */
    public function getByUserId(int $userId): \Generator
    {
        return $this->itemRepository->findByUserId($userId);
    }

    /**
     * @return FullItemDTO[]|\Generator
     */
    public function getAll(): \Generator
    {
        return $this->itemRepository->findAll();
    }

    public function edit(EditItemDTO $item, int $userId)
    {
       $items = $this->itemRepository->findByUserId($userId);
       $hasItem = false;
       foreach ($items as $userItem) {
           if ($userItem->getId() == $item->getId()) {
               $hasItem = true;
               break;
           }
       }

       if (!$hasItem) {
           throw new \Exception('Not an owner');
       }

       $this->itemRepository->edit($item);
    }

    public function getOne(int $id): FullItemDTO
    {
        return $this->itemRepository->findOne($id);
    }

    public function delete(int $itemId, int $userId)
    {
        $item = $this->getOne($itemId);

        if ($item->getUserId() != $userId) {
            throw new \Exception('Not an owner');
        }

        $this->itemRepository->delete($itemId);
    }
}