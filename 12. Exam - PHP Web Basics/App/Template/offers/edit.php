<h1>EDIT ITEM</h1>

<?php /** @var array $errors |null */ ?>
<?php /** @var \App\Data\EditOfferDTO $data */ ?>

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
            <?php foreach($data->getTowns() as $town): ?>
                <option value="<?=$town->getId();?>"><?=$town->getName();?></option>
            <?php endforeach; ?>
        </select>
        <br />
    </label>
    <label>
        Room Type:
        <select name="room_id">
            <?php foreach($data->getRooms() as $room):?>
                <option value="<?=$room->getId();?>"><?=$room->getType();?></option>
            <?php endforeach; ?>
        </select>
        <br />
    </label>
    <label>
        Image URL: <input type="text" name="picture_url" value="<?=$data->getPictureurl();?>"/><br />
    </label>
    <label>
        Description: <textarea name="description"><?=$data->getDescription();?></textarea>
    </label>
    <br/>
    <label>
        Days: <input type="number" value="<?=$data->getDays();?>" name="days"/><br />
    </label>
    <label>
        Price: <input type="number" value="<?=$data->getPrice();?>" name="price"/><br />
    </label>
        Is Occupied: <input type="checkbox" name="isOccupied" value="1" /><br />
    <input type="submit" name="edit" value="Edit Offer"/> <br />

</form>
