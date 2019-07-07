<h1>Add New Offer</h1>

<?php /** @var array $errors |null */ ?>
<?php /** @var \App\Data\TownDTO[] $data */?>

<?php foreach ($errors as $error): ?>
    <p style="color: red"><?= $error ?></p>
<?php endforeach; ?>

<a href="profile.php">My Profile</a>
<br/>
<br/>


<form method="post">
    <label>
        Town:
        <select name="town_id">
            <?php foreach($data['towns'] as $town): ?>
            <option value="<?=$town->getId();?>"><?=$town->getName();?></option>
            <?php endforeach; ?>
        </select>
        <br />
    </label>
    <label>
        Room Type:
        <select name="room_id">
            <?php foreach($data['rooms'] as $room):?>
                <option value="<?=$room->getId();?>"><?=$room->getType();?></option>
            <?php endforeach; ?>
        </select>
        <br />
    </label>
    <label>
        Image URL: <input type="text" name="picture_url"/><br />
    </label>
    <label>
        Description: <textarea name="description"></textarea>
    </label>
    <br/>
    <label>
        Days: <input type="number" value="0" name="days"/><br />
    </label>
    <label>
        Price: <input type="number" value="0" name="price"/><br />
    </label>
    <input type="submit" name="add" value="Add"/> <br />

</form>
