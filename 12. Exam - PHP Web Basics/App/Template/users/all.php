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
                <td><?= $userDTO->getEmail(); ?></td>
                <td><?= $userDTO->getName(); ?></td>
                <td><?= $userDTO->getMoneyspent() ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>

</table>

<br />
Go back to <a href="profile.php">your profile</a>
