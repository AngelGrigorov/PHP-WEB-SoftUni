<?php

namespace Services\Users;


use Data\Users\UserDTO;
use Data\Users\UserEditDTO;
use Exception\User\EditProfileException;
use Exception\User\RegistrationException;
use Exception\User\UploadException;
use Repositories\Users\UserRepositoryInterface;
use Services\Encryption\EncryptionServiceInterface;

class UserService implements UserServiceInterface
{
    const MIN_USER_LENGTH = 5;
    const MAX_ALLOWED_SIZE = 30000;
    const ALLOWED_IMAGE_PREFIX = 'image/';

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var EncryptionServiceInterface
     */
    private $encryptionService;

    public function __construct(UserRepositoryInterface $userRepository, EncryptionServiceInterface $encryptionService)
    {
        $this->userRepository = $userRepository;
        $this->encryptionService = $encryptionService;
    }


    public function register(UserDTO $userDTO)
    {
        if ($userDTO->getPassword() != $userDTO->getConfirmPassword()) {
            throw new RegistrationException("Password mismatch");
        }

        if (strlen($userDTO->getUsername()) < self::MIN_USER_LENGTH) {
            throw new RegistrationException("User length too short");
        }

        $passwordHash = $this->encryptionService->hash($userDTO->getPassword());
        $userDTO->setPassword($passwordHash);

        $this->userRepository->register($userDTO);
    }

    public function edit(int $id, UserEditDTO $userDTO): void
    {
        $user = $this->userRepository->getById($id);
        $changePassword = false;
        if ($userDTO->getOldPassword() && $userDTO->getNewPassword()) {
            if (!$this->verifyCredentials($user->getUsername(), $userDTO->getOldPassword())) {
                throw new EditProfileException('Password mismatch');
            }
            $changePassword = true;
        }

        if ($changePassword) {
            $userDTO->setNewPassword(
                $this->encryptionService->hash($userDTO->getNewPassword())
            );
        }

        $this->userRepository->edit($id, $userDTO, $changePassword);
    }

    public function verifyCredentials(string $username, string $password): bool
    {
        $user = $this->userRepository->getByUsername($username);

        return $this->encryptionService->verify($password, $user->getPassword());
    }

    public function findByUsername(string $username): UserDTO
    {
        return $this->userRepository->getByUsername($username);
    }

    public function findOne(int $id): UserDTO
    {
        return $this->userRepository->getById($id);
    }

    public function setProfilePicture(int $id, string $tempName, string $type, int $size)
    {
        if (strpos($type, self::ALLOWED_IMAGE_PREFIX) !== 0) {
            throw new UploadException("Invalid image type");
        }

        if ($size >= self::MAX_ALLOWED_SIZE) {
            throw new UploadException("Image too big");
        }



        $filePath = 'public/images/' . uniqid('profile_') . '.' . explode("/", $type)[1];

        if (!move_uploaded_file(
            $tempName,
            $filePath
        )) {
            throw new UploadException("Error uploading file");
        }

        $this->userRepository->setPictureUrl($id, $filePath);
    }
}