<?php
/**
 * @var \App\Data\UserDTO[] $data
 */
?>
<h1>ALL USERS</h1>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Full Name</th>
            <th>Born on</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $user): ?>
        <tr>
            <td>
                <?=$user->getId();?>
            </td>
            <td>
                <?=$user->getUsername();?>
            </td>
            <td>
                <?=$user->getFirstName() . ' ' . $user->getLastName();?>
            </td>
            <td>
                <?=$user->getBornOn();?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<p>Go back to your <a href="profile.php">profile</a>.</p>