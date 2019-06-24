<?php

namespace App\Http;

use App\Data\ErrorDTO;
use App\Data\UserDTO;
use App\Service\UserServiceInterface;

class HttpHandler extends HttpHandlerAbstract
{
    public function index(){
        $this->render('home/index');
    }

    public function allUsers(UserServiceInterface $userService){
        $this->render('users/all', $userService->all());
    }

    public function profile(UserServiceInterface $userService, array $formData = [])
    {
        $currentUser = $userService->currentUser();

        if ($currentUser == null) {
            $this->redirect('login.php');
        }

        if(isset($formData['edit'])){
            $this->handleEditProcess($userService, $formData);
        } else {
            $this->render('users/profile', $currentUser);
        }
    }

    public function login(UserServiceInterface $userService, array $formData = [])
    {
        if (isset($formData['login'])) {
            $this->handleLoginProcess($userService, $formData);
        } else {
            $this->render('users/login');
        }
    }

    public function register(UserServiceInterface $userService, array $formData = [])
    {
        if (isset($formData['register'])) {
            $this->handleRegisterProcess($userService, $formData);
        } else {
            $this->render("users/register");
        }
    }

    /**
     * @param UserServiceInterface $userService
     * @param array $formData
     */
    public function handleRegisterProcess(UserServiceInterface $userService, array $formData): void
    {
        $user = UserDTO::create(
            $formData['username'],
            $formData['password'],
            $formData['first_name'],
            $formData['last_name'],
            $formData['born_on']
        );

        if ($userService->register($user, $formData['confirm_password'])) {
            $this->redirect("login.php");
        } else {
            # error
            $this->render('app/error', new ErrorDTO("Username is already taken."));
        }
    }

    /**
     * @param UserServiceInterface $userService
     * @param array $formData
     */
    public function handleLoginProcess(UserServiceInterface $userService, array $formData): void
    {
        $currentUser = $userService->login($formData['username'], $formData['password']);

        if ($currentUser !== null) {
            $_SESSION['id'] = $currentUser->getId();
            $this->redirect('profile.php');
        } else {
            # error
            $this->render('app/error', new ErrorDTO("Username does not exists or password mismatch."));
        }
    }

    public function handleEditProcess(UserServiceInterface $userService, array $formData): void
    {
        $user = UserDTO::create(
            $formData['username'],
            $formData['password'],
            $formData['first_name'],
            $formData['last_name'],
            $formData['born_on']
        );

        if ($userService->edit($user)){
            $this->redirect('profile.php');
        } else {
            # error
            $this->render('app/error', new ErrorDTO("Error editing your profile."));
        }
    }
}