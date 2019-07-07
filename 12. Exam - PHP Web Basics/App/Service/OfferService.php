<?php

namespace App\Service;


use App\Data\EditOfferDTO;
use App\Data\FullOfferDTO;
use App\Data\OfferDTO;
use App\Data\MyOfferDTO;
use App\Repository\OfferRepositoryInterface;
use App\Repository\UserRepositoryInterface;

class OfferService implements OfferServiceInterface
{
    /**
     * @var OfferRepositoryInterface
     */
    private $itemRepository;
    private $userRepository;

    /**
     * OfferService constructor.
     * @param OfferRepositoryInterface $itemRepository
     */
    public function __construct(OfferRepositoryInterface $itemRepository, UserRepositoryInterface $userRepository)
    {
        $this->itemRepository = $itemRepository;
        $this->userRepository = $userRepository;
    }


    public function create(OfferDTO $item)
    {
        $this->itemRepository->add($item);
    }

    /**
     * @param int $userId
     * @return MyOfferDTO[]|\Generator
     */
    public function getByUserId(int $userId): \Generator
    {
        return $this->itemRepository->findByUserId($userId);
    }

    /**
     * @return FullOfferDTO[]|\Generator
     */
    public function getAll(): \Generator
    {
        return $this->itemRepository->findAll();
    }

    public function edit(EditOfferDTO $item, int $userId)
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

    public function getOne(int $id): FullOfferDTO
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
    public function rent(int $itemId, int $userId)
    {
        $item = $this->getOne($itemId);

        $this->userRepository->rent($item, $userId);
        $this->itemRepository->rent($itemId);
    }
}
