<h2>Register Form</h2>

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
        Birthday: <input type="text" name="born_on"/><br />
    </label>
    <input type="submit" name="register" value="Register"/> <br />

</form>

<a href="index.php">back</a>