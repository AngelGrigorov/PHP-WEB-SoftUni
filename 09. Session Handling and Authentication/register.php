<?php
require_once 'common.php';

$error = '';
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $userService = new \Services\Users\UserService(
        new \Repositories\Users\UserRepository($db),
        new \Services\Encryption\MnogoTypEncryptioService()
    );

    $userDTO = new \Data\Users\UserDTO(-1, $username, $password, $confirm);

    try {
        $userService->register($userDTO);
        header("Location: login.php");
        exit;
    } catch (\Exception\User\RegistrationException $e) {
        $error = $e->getMessage();
    } catch (Exception $e) {
        $error = "Something went wrong";
    }
}

require_once 'views/users/register.php';