<?php

namespace App\Repository;


use App\Data\FullOfferDTO;
use App\Data\OfferDTO;
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
            "INSERT INTO users(email, password, name, phone)
                  VALUES(?,?,?,?)
             "
        )->execute([
            $userDTO->getEmail(),
            $userDTO->getPassword(),
            $userDTO->getName(),
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
                  email = ?,
                  password = ?,
                  name = ?,
                  phone = ?,
                  money_spent = ?
                WHERE id = ? 
            "
        )->execute([
            $userDTO->getEmail(),
            $userDTO->getPassword(),
            $userDTO->getName(),
            $userDTO->getMoneyspent(),
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

    public function rent(FullOfferDTO $item, $userId): bool
    {
        $money = $item->getDays() * $item->getPrice();
        $this->db->query("
        UPDATE users
        SET money_spent = money_spent + $money
        WHERE id = ?
        ")->execute([$userId]);
        return true;
    }

    public function findOneByEmail(string $email): ?UserDTO
    {
        return $this->db->query(
            "SELECT id, 
                    email, 
                    password, 
                    name,
                    phone,
                    money_spent
                  FROM users
                  WHERE email = ?
             "
        )->execute([$email])
            ->fetch(UserDTO::class)
            ->current();

    }

    public function findOneById(int $id): ?UserDTO
    {
        return $this->db->query(
            "SELECT id,
                    email, 
                    password, 
                    name,
                    phone,
                    money_spent
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
                      email, 
                      password, 
                      name, 
                      phone,
                      money_spent
                  FROM users
            "
        )->execute()
            ->fetch(UserDTO::class);
    }
}
