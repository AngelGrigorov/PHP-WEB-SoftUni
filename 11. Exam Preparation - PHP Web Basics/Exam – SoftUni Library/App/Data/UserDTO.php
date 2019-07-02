<?php

namespace App\Data;


class UserDTO
{
    private const USERNAME_MIN_LENGTH = 4;
    private const USERNAME_MAX_LENGTH = 255;

    private const PASSWORD_MIN_LENGTH = 4;
    private const PASSWORD_MAX_LENGTH = 255;

    private const FULL_NAME_MIN_LENGTH = 5;
    private const FULL_NAME_MAX_LENGTH = 255;

    private $id;
    private $username;
    private $password;
    private $fullName;
    private $bornOn;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): UserDTO
    {
        $this->id = $id;
        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param $username
     * @return UserDTO
     * @throws \Exception
     */
    public function setUsername($username): UserDTO
    {
        DTOValidator::validate(self::USERNAME_MIN_LENGTH, self::USERNAME_MAX_LENGTH,
            $username, "text", "Username");
        $this->username = $username;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $password
     * @return UserDTO
     * @throws \Exception
     */
    public function setPassword($password): UserDTO
    {
        DTOValidator::validate(self::PASSWORD_MIN_LENGTH, self::PASSWORD_MAX_LENGTH,
            $password, "text", "Password");
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param mixed $fullName
     * @return UserDTO
     * @throws \Exception
     */
    public function setFullName($fullName): UserDTO
    {
        DTOValidator::validate(
            self::FULL_NAME_MIN_LENGTH,
            self::FULL_NAME_MAX_LENGTH,
            $fullName,
            "text",
            "Full Name");
        $this->fullName = $fullName;
        return $this;
    }


    public function getBornOn()
    {
        return $this->bornOn;
    }

    public function setBornOn($bornOn): UserDTO
    {
        $this->bornOn = $bornOn;
        return $this;
    }


}