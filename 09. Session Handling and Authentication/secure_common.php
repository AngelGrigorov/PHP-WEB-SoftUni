<?php
require_once 'common.php';
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['id'];

$userService = new \Services\Users\UserService(
    new \Repositories\Users\UserRepository($db),
    new \Services\Encryption\MnogoTypEncryptioService()
);

$user = $userService->findOne($id);