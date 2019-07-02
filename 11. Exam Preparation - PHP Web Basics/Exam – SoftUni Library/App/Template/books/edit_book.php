<?php /** @var \App\Data\EditBookDTO $data */ ?>
<?php /** @var array $errors |null */ ?>

<h1>EDIT BOOK</h1>

<a href="profile.php">My Profile</a><br/><br/>

<?php foreach ($errors as $error): ?>
    <p style="color: red"><?= $error ?></p>
<?php endforeach; ?>

<form method="post">
    Book Title: <input type="text" name="title" value="<?= $data->getBook()->getTitle(); ?>"/> <br/>
    Book Author: <input type="text" name="author" value="<?= $data->getBook()->getAuthor(); ?>"/><br/>
    Description: <textarea rows="5" name="description"><?= $data->getBook()->getDescription();?></textarea><br/>
    Image URL: <input type="text" name="image_url" value="<?= $data->getBook()->getImageURL(); ?>"/><br/>
    Genre: <select name="genre_id"><br/>
        <?php foreach ($data->getGenres() as $genre): ?>
            <?php if ($data->getBook()->getGenre()->getId() === $genre->getId()): ?>
                <option selected="selected" value="<?= $genre->getId(); ?>"><?= $genre->getName(); ?></option>
            <?php else: ?>
                <option value="<?= $genre->getId(); ?>"><?= $genre->getName(); ?></option>
            <?php endif; ?>
        <?php endforeach; ?>
    </select><br/>
    <img src="<?= $data->getBook()->getImageURL(); ?>" alt="None" width="200" height="100" /><br />
    <input type="submit" value="Edit" name="edit"/><br/>
</form>