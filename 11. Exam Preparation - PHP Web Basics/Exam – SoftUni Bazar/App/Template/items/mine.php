<h1>MY ITEMS</h1>

<?php /** @var \App\Data\MyItemDTO[] $data */ ?>

<a href="add_item.php">Add new Item</a> | <a href="profile.php">My Profile</a> |
<a href="logout.php">Logout</a>
<br/>

<table border="1">
    <thead>
    <tr>
        <th>Title</th>
        <th>Category</th>
        <th>Price</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $item): ?>
    <tr>
        <td><?=$item->getTitle();?></td>
        <td><?=$item->getCategory();?></td>
        <td><?=$item->getPrice();?></td>
        <td><a href="edit.php?id=<?=$item->getId();?>">Edit</a></td>
        <td><a href="delete.php?id=<?=$item->getId();?>">Delete</a></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

