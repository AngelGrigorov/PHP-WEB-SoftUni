<?php
require_once 'secure_common.php';

$errors = [];

if (isset($_POST['edit'])) {
    $username = $_POST['username'];
    $oldPassword = $_POST['old'];
    $newPassword = $_POST['new'];

    if (isset($_FILES['profile_picture'])) {
        try {
            $userService->setProfilePicture(
                $id,
                $_FILES['profile_picture']['tmp_name'],
                $_FILES['profile_picture']['type'],
                $_FILES['profile_picture']['size']
            );
        } catch (\Exception\User\UploadException $e) {
            $errors[] = $e->getMessage();
        }
    }

    try {
        $userService->edit($id, new \Data\Users\UserEditDTO($id, $username, $oldPassword, $newPassword));
        header("Location: profile.php");
        exit;
    } catch (\Exception\User\EditProfileException $e) {
        $errors[] = $e->getMessage();
    } catch (Exception $_) {
        $errors[] = 'Something went wrong';
    }
}

require_once 'views/users/edit_profile.php';