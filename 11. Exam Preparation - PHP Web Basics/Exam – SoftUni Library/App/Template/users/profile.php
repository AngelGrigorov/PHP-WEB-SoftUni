<?php /** @var \App\Data\UserDTO $data */ ?>

<h1>Hello, <?= $data->getFullName(); ?></h1>

<a href="add_book.php">Add new book</a> |
    <a href="myProfile.php">Edit Profile</a> |
        <a href="logout.php">logout</a>

<br /><br />

<a href="my_books.php">My Books</a> <br />
<a href="all_b
ooks.php">All Books</a>