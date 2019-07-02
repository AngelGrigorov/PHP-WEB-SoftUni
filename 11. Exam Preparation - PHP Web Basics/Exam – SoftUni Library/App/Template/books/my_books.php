<?php /** @var \App\Data\BookDTO[] $data */ ?>

<h1>MY BOOKS</h1>

<a href="add_book.php">Add new book</a> |
<a href="myProfile.php">My Profile</a> |
<a href="logout.php">logout</a>

<br /><br />

<table border="1">
    <thead>
    <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Genre</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($data as $bookDTO): ?>
        <tr>
            <td><?= $bookDTO->getTitle(); ?></td>
            <td><?= $bookDTO->getAuthor(); ?></td>
            <td><?= $bookDTO->getGenre()->getName(); ?></td>
            <td><a href="edit_book.php?id=<?= $bookDTO->getId(); ?>">edit book</a></td>
            <td><a href="delete_book.php?id=<?= $bookDTO->getId(); ?>">delete book</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>

</table>