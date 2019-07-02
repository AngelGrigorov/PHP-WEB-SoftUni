<h1>REGISTER NEW USER</h1>

<?php /** @var array $errors |null */ ?>

<?php foreach ($errors as $error): ?>
    <p style="color: red"><?= $error ?></p>
<?php endforeach; ?>

<form method="post">
    <label>
        Username: <input type="text" name="username"/> <br />
    </label>
    <label>
        Password: <input type="text" name="password"/> <br />
    </label>
    <label>
        Confirm Password: <input type="text" name="confirm_password"/> <br />
    </label>
    <label>
        Full Name: <input type="text" name="full_name"/><br />
    </label>
    <label>
        Location: <input type="text" name="location"/><br />
    </label>
    <label>
        Phone: <input type="text" name="phone"/><br />
    </label>
    <input type="submit" name="register" value="Register"/> <br />

</form>

<a href="index.php">back</a>