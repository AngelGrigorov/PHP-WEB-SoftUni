<?php
namespace Data\Users;

class UserEditDTO
{
    private $id;

    private $username;

    private $oldPassword;

    private $newPassword;

    /**
     * UserEditDTO constructor.
     * @param $id
     * @param $username
     * @param $oldPassword
     * @param $newPassword
     */
    public function __construct($id, $username, $oldPassword, $newPassword)
    {
        $this->id = $id;
        $this->username = $username;
        $this->oldPassword = $oldPassword;
        $this->newPassword = $newPassword;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getOldPassword()
    {
        return $this->oldPassword;
    }

    /**
     * @param mixed $oldPassword
     */
    public function setOldPassword($oldPassword): void
    {
        $this->oldPassword = $oldPassword;
    }

    /**
     * @return mixed
     */
    public function getNewPassword()
    {
        return $this->newPassword;
    }

    /**
     * @param mixed $newPassword
     */
    public function setNewPassword($newPassword): void
    {
        $this->newPassword = $newPassword;
    }




}