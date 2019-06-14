<?php
namespace Data\Users;

class UserDTO
{
    private $id;

    private $username;

    private $password;

    private $confirmPassword;

    private $profilePictureUrl;

    /**
     * UserDTO constructor.
     * @param $id
     * @param $username
     * @param $password
     * @param $confirmPassword
     * @param $profilePictureUrl
     */
    public function __construct($id, $username, $password, $confirmPassword, $profilePictureUrl = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
        $this->profilePictureUrl = $profilePictureUrl;
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
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getConfirmPassword()
    {
        return $this->confirmPassword;
    }

    /**
     * @param mixed $confirmPassword
     */
    public function setConfirmPassword($confirmPassword): void
    {
        $this->confirmPassword = $confirmPassword;
    }

    /**
     * @return mixed
     */
    public function getProfilePictureUrl()
    {
        return $this->profilePictureUrl;
    }

    /**
     * @param mixed $profilePictureUrl
     */
    public function setProfilePictureUrl($profilePictureUrl): void
    {
        $this->profilePictureUrl = $profilePictureUrl;
    }




}