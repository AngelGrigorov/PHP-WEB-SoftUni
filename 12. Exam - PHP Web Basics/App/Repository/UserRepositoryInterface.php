<?php

namespace App\Repository;


use App\Data\FullOfferDTO;
use App\Data\UserDTO;

interface UserRepositoryInterface
{
    public function insert(UserDTO $userDTO) : bool;
    public function update(int $id, UserDTO $userDTO) : bool;
    public function delete(int $id) : bool;
    public function rent(FullOfferDTO $itemDTO, $userId) : bool;
    public function findOneByEmail(string $email) : ?UserDTO;
    public function findOneById(int $id) : ?UserDTO;

    /**
     * @return \Generator|UserDTO[]
     */
    public function findAll() : \Generator;
}
