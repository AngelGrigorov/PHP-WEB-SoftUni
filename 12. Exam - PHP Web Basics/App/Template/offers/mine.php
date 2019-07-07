<h1>My offers</h1>

<?php /** @var \App\Data\MyOfferDTO[] $data */
?>

<a href="add_offer.php">Add new offer</a> | <a href="profile.php">My Profile</a> |
<a href="logout.php">Logout</a>
<br/>

<table border="1">
    <thead>
    <tr>
        <th>Town</th>
        <th>Type</th>
        <th>Days</th>
        <th>Price</th>
        <th>Is Available</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $item): ?>
    <tr>
        <td><?=$item->getTown();?></td>
        <td><?=$item->getRoom();?></td>
        <td><?=$item->getDays();?></td>
        <td><?=$item->getPrice();?></td>
        <td><?=$item->getIsOccupied();?></td>
        <td><a href="edit_offer.php?id=<?=$item->getId();?>">edit offer</a></td>
        <td><a href="delete_offer.php?id=<?=$item->getId();?>">delete offer</td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

