<h1>All Offers</h1>

<?php /** @var \App\Data\FullOfferDTO[] $data */ ?>

<a href="add_offer.php">Add new offer</a> | <a href="profile.php">My Profile</a> |
<a href="logout.php">Logout</a>
<br/>

<table border="1" style="text-align: center;">
    <thead>
    <tr>
        <th>Picture</th>
        <th>Town</th>
        <th>Type</th>
        <th>Days</th>
        <th>Total Price</th>
        <th>Is Available</th>
        <th>Details</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $item):
    $isOccupied = $item->getIsOccupied() == "No" ? "No" : "<a href=\"rent.php?id={$item->getId()}\">rent</a>";
    ?>
    <tr>
        <td><img src="<?=$item->getPictureUrl();?>" style="width: 250px" /></td>
        <td><?=$item->getTown();?></td>
        <td><?=$item->getRoom();?></td>
        <td><?=$item->getDays();?></td>
        <td><?=($item->getDays() * $item->getPrice());?></td>
        <td><?=$isOccupied;?></td>
        <td><a href="view_offer.php?id=<?=$item->getId();?>">Details</a></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

