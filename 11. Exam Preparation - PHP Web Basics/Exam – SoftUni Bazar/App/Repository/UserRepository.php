<?php

namespace App\Repository;


use App\Data\UserDTO;
use Core\DataBinderInterface;
use Database\DatabaseInterface;

class UserRepository extends DatabaseAbstract implements UserRepositoryInterface
{

    public function __construct(DatabaseInterface $database,
                                DataBinderInterface $dataBinder)
    {
        parent::__construct($database, $dataBinder);
    }

    public function insert(UserDTO $userDTO): bool
    {
        $this->db->query(
            "INSERT INTO users(username, password, full_name, location, phone)
                  VALUES(?,?,?,?,?)
             "
        )->execute([
            $userDTO->getUsername(),
            $userDTO->getPassword(),
            $userDTO->getFullName(),
            $userDTO->getLocation(),
            $userDTO->getPhone()
        ]);

        return true;
    }

    public function update(int $id, UserDTO $userDTO): bool
    {
        $this->db->query(
            "
                UPDATE users
                SET 
                  username = ?,
                  password = ?,
                  full_name = ?,
                  location = ?,
                  phone = ?
                WHERE id = ? 
            "
        )->execute([
            $userDTO->getUsername(),
            $userDTO->getPassword(),
            $userDTO->getFullName(),
            $userDTO->getLocation(),
            $userDTO->getPhone(),
            $id
        ]);

        return true;
    }

    public function delete(int $id): bool
    {
        $this->db->query("DELETE FROM users WHERE id = ?")
            ->execute([$id]);

        return true;
    }

    public function findOneByUsername(string $username): ?UserDTO
    {
        return $this->db->query(
            "SELECT id, 
                    username, 
                    password, 
                    full_name AS fullName,
                    location,
                    phone
                  FROM users
                  WHERE username = ?
             "
        )->execute([$username])
            ->fetch(UserDTO::class)
            ->current();

    }

    public function findOneById(int $id): ?UserDTO
    {
        return $this->db->query(
            "SELECT id,
                    username, 
                    password, 
                    full_name AS fullName,
                    location,
                    phone
                  FROM users
                  WHERE id = ?
             "
        )->execute([$id])
            ->fetch(UserDTO::class)
            ->current();
    }

    /**
     * @return \Generator|UserDTO[]
     */
    public function findAll(): \Generator
    {
        return $this->db->query(
            "
                  SELECT id, 
                      username, 
                      password, 
                      full_name AS fullName, 
                      location,
                      phone
                  FROM users
            "
        )->execute()
            ->fetch(UserDTO::class);
    }
}