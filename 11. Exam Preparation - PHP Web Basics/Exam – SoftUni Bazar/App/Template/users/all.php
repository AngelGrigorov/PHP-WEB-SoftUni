<?php /** @var \App\Data\UserDTO[] $data */ ?>

<table border="1">
    <thead>
    <tr>
        <td>Id</td>
        <td>Username</td>
        <td>Fullname</td>
        <td>BornOn</td>
    </tr>
    </thead>

    <tbody>
        <?php foreach ($data as $userDTO): ?>
            <tr>
                <td><?= $userDTO->getId(); ?></td>
                <td><?= $userDTO->getUsername(); ?></td>
                <td><?= $userDTO->getFullName(); ?></td>
                <td><?= $userDTO->getLocation() ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>

</table>

<br />
Go back to <a href="profile.php">your profile</a>