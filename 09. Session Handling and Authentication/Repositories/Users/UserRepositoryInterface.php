<?php

namespace Repositories\Users;


use Data\Users\UserDTO;
use Data\Users\UserEditDTO;

interface UserRepositoryInterface
{
    public function getAll(): \Generator;

    public function register(UserDTO $userDTO);

    public function getByUsername(string $username): UserDTO;

    public function getById(int $id): UserDTO;

    public function edit(int $id, UserEditDTO $userEditDTO, bool $changePassword);

    public function setPictureUrl(int $id, string $filePath);
}