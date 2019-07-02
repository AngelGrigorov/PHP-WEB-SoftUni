<h1>ADD ITEM</h1>

<?php /** @var array $errors |null */ ?>
<?php /** @var \App\Data\CategoryDTO[] $data */ ?>

<?php foreach ($errors as $error): ?>
    <p style="color: red"><?= $error ?></p>
<?php endforeach; ?>

<a href="profile.php">My Profile</a>
<br/>
<br/>


<form method="post">
    <label>
        Title: <input type="text" name="title"/> <br />
    </label>
    <label>
        Price: <input type="text" name="price"/> <br />
    </label>
    <label>
        Category:
        <select name="category_id">
            <?php foreach ($data as $category): ?>
            <option value="<?=$category->getId();?>"><?=$category->getName();?></option>
            <?php endforeach; ?>
        </select>
    </label>
    <br/>
    <label>
        Description: <textarea name="description"></textarea>
    </label>
    <br/>
    <label>
        Image URL: <input type="text" name="image"/><br />
    </label>
    <input type="submit" name="add" value="Add"/> <br />

</form>
