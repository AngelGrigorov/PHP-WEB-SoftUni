<h1>Offer № <?=$_GET['id'];?></h1>

<?php /** @var array $errors |null */ ?>
<?php /** @var \App\Data\FullOfferDTO $data */ ?>

<?php foreach ($errors as $error): ?>
    <p style="color: red"><?= $error ?></p>
<?php endforeach; ?>

<a href="profile.php">My Profile</a>
<br/>
<br/>
<p><img src="<?=$data->getPictureUrl()?>" style="width: 400px;"></p>
<p>Town: <?=$data->getTown()?></p>
<p>Town: <?=$data->getRoom()?></p>
<p>Description: <?=$data->getDescription()?></p>
<p>Days: <?=$data->getDays()?></p>
<p>Price: $<?=$data->getPrice()?></p>
<p>Total Price: $<?=$data->getPrice() * $data->getDays()?></p>
<p>Is Available: <?=$data->getIsOccupied() ?></p>
<br>
<hr>
<p>Offer Author: <?=$data->getUser();?></p>
<p>Offer Phone: <?=$data->getOfferPhone();?></p>
