<h1>VIEW ITEM</h1>

<?php /** @var array $errors |null */ ?>
<?php /** @var \App\Data\FullItemDTO $data */ ?>

<?php foreach ($errors as $error): ?>
    <p style="color: red"><?= $error ?></p>
<?php endforeach; ?>

<a href="profile.php">My Profile</a>
<br/>
<br/>

<b>Title: </b> <?= $data->getTitle(); ?><br/>
<b>Price: </b> <?= $data->getPrice(); ?><br/>
<b>Category: </b> <?= $data->getCategory(); ?><br/>
<b>Phone: </b> <?= $data->getPhone(); ?><br/>
<b>Description: </b> <?= $data->getDescription(); ?><br/>


<img src="<?=$data->getImage();?>"/>