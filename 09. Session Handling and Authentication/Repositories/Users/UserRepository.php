<?php
namespace Repositories\Users;

use Data\Users\UserDTO;
use Data\Users\UserEditDTO;
use Database\DatabaseInterface;

class UserRepository implements UserRepositoryInterface
{
    private $db;

    /**
     * UserRepository constructor.
     * @param $db
     */
    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }


    public function getAll(): \Generator
    {
        return $this->db->query("SELECT * FROM users")->execute()->fetch();
    }

    public function register(UserDTO $userDTO)
    {
        $this->db->query("INSERT INTO users (username, password) VALUES (?, ?)")
            ->execute([$userDTO->getUsername(), $userDTO->getPassword()]);
    }

    public function getByUsername(string $username): UserDTO
    {
        $user = $this->db->query("SELECT * FROM users WHERE username = ?")->execute([$username])->fetch();
        $user = $user->current();

        return new UserDTO($user['id'], $user['username'], $user['password'], '', $user['profile_picture_url']);
    }

    public function getById(int $id): UserDTO
    {
        $user = $this->db->query("SELECT * FROM users WHERE id = ?")->execute([$id])->fetch();
        $user = $user->current();

        return new UserDTO($user['id'], $user['username'], $user['password'], '', $user['profile_picture_url']);
    }

    public function edit(int $id, UserEditDTO $userEditDTO, bool $changePassword)
    {
        $query = "UPDATE users SET username = ?";
        $params = [$userEditDTO->getUsername()];
        if ($changePassword) {
            $query .= ", password = ?";
            $params[] = $userEditDTO->getNewPassword();
        }
        $query .= " WHERE id = ?";
        $params[] = $id;

        $this->db->query($query)->execute($params);
    }

    public function setPictureUrl(int $id, string $filePath)
    {
        $this->db->query("UPDATE users SET profile_picture_url = ? WHERE id = ?")
            ->execute([$filePath, $id]);
    }
}