<?php

namespace App\Service\Books;


use App\Data\BookDTO;
use App\Repository\Books\BookRepositoryInterface;
use App\Service\UserServiceInterface;

class BookService implements BookServiceInterface
{
    /**
     * @var BookRepositoryInterface
     */
    private $bookRepository;

    /**
     * @var UserServiceInterface
     */
    private $userService;

    public function __construct(BookRepositoryInterface $bookRepository,
                                UserServiceInterface $userService)
    {
        $this->bookRepository = $bookRepository;
        $this->userService = $userService;
    }


    public function add(BookDTO $bookDTO): bool
    {
        return $this->bookRepository->insert($bookDTO);
    }

    public function edit(BookDTO $bookDTO): bool
    {
        return $this->bookRepository->update($bookDTO, $bookDTO->getId());
    }

    public function delete(int $id): bool
    {
        return $this->bookRepository->remove($id);
    }

    /**
     * @return \Generator|BookDTO[]
     */
    public function getAll(): \Generator
    {
        return $this->bookRepository->findAll();
    }

    public function getOneById(int $id): BookDTO
    {
        return $this->bookRepository->findOneById($id);
    }

    public function getAllByAuthor()
    {
        $currentUser = $this->userService->currentUser();

        return $this->bookRepository->findAllByAuthorId($currentUser->getId());
    }
}