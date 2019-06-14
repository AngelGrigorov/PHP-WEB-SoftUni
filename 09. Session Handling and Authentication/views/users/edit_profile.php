<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit your profile</title>
</head>
<body>
<h1>Edit profile</h1>
<?php foreach ($errors as $error): ?>
<div id="error" style="color:red">
    <h1><?=$error;?></h1>
</div>
<?php endforeach; ?>
<form method="post" enctype="multipart/form-data">
    Username: <input type="text" value="<?=$user->getUsername();?>" name="username"><br/>
    Old Password: <input type="password" name="old"><br/>
    New Password: <input type="password" name="new"><br/>
    Profile picture: <input type="file" name="profile_picture"/><br/>
    <input type="submit" name="edit" value="Edit!"/>
</form>
</body>
</html>