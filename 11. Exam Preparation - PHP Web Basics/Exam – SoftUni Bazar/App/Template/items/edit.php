<h1>EDIT ITEM</h1>

<?php /** @var array $errors |null */ ?>
<?php /** @var \App\Data\EditItemDTO $data */ ?>

<?php foreach ($errors as $error): ?>
    <p style="color: red"><?= $error ?></p>
<?php endforeach; ?>

<a href="profile.php">My Profile</a>
<br/>
<br/>


<form method="post">
    <label>
        Title: <input type="text" name="title" value="<?=$data->getTitle();?>"/> <br />
    </label>
    <label>
        Price: <input type="text" name="price"/ value="<?=$data->getPrice();?>"> <br />
    </label>
    <label>
        Category:
        <select name="category_id">
            <?php foreach ($data->getCategories() as $category): ?>
            <option <?= $category->getId() == $data->getCategoryId() ? 'selected' : ''?> value="<?=$category->getId();?>"><?=$category->getName();?></option>
            <?php endforeach; ?>
        </select>
    </label>
    <br/>
    <label>
        Description: <textarea name="description"><?=$data->getDescription();?></textarea>
    </label>
    <br/>
    <label>
        Image URL: <input type="text" name="image" value="<?=$data->getImage();?>"/><br />
    </label>

    <img src="<?=$data->getImage();?>"/><br/>
    <input type="submit" name="edit" value="Edit"/> <br />

</form>
