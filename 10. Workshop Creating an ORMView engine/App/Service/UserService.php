<?php

namespace App\Service;

use App\Data\UserDTO;
use App\Repository\UserRepositoryInterface;

class UserService implements UserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * UserService constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(UserDTO $userDTO, string $confirmPassword): bool
    {
       if($userDTO->getPassword() !== $confirmPassword){
            return false;
       }

       if($this->userRepository->findOneByUsername($userDTO->getUsername()) !== null){
            return false;
       }

        $this->encryptPassword($userDTO);

        return $this->userRepository->insert($userDTO);
    }

    public function login(string $username, string $password): ?UserDTO
    {
        $currentUser = $this->userRepository->findOneByUsername($username);

        if($currentUser === null){
            return null;
        }

        $userPasswordHash = $currentUser->getPassword();

        if(false === password_verify($password, $userPasswordHash)){
            return null;
        }

        return $currentUser;
    }

    public function currentUser(): ?UserDTO
    {
        if(!isset($_SESSION['id'])){
            return null;
        }

        return $this->userRepository->findOneById($_SESSION['id']);
    }

    public function edit(UserDTO $userDTO): bool
    {
        $currentUser = $this->userRepository->findOneByUsername($userDTO->getUsername());
        if($currentUser !== null){
            return false;
        }
//
//        if($userDTO->getId() !== $_SESSION['id']){
//            return false;
//        }

        $this->encryptPassword($userDTO);
        return $this->userRepository->update($_SESSION['id'], $userDTO);
    }

    /**
     * @param UserDTO $userDTO
     */
    public function encryptPassword(UserDTO $userDTO): void
    {
        $plainTextPassword = $userDTO->getPassword();
        $hashPassword = password_hash($plainTextPassword, PASSWORD_DEFAULT);
        $userDTO->setPassword($hashPassword);
    }

    /**
     * @return \Generator|UserDTO[]
     */
    public function all(): \Generator
    {
        return $this->userRepository->findAll();
    }
}