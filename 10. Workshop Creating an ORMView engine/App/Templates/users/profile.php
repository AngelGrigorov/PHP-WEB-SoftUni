
<?php
/**
 * @var \App\Data\UserDTO $data
 */
?>
<h1>YOUR PROFILE</h1>

<form method="POST">
    <div>
        <label> Username:
            <input type="text" value="<?=$data->getUsername();?>" name="username"/>
        </label>
    </div>
    <div>
        <label> Password:
            <input type="password" required="required" name="password"/>
        </label>
    </div>
    <div>
        <label>First Name:
            <input type="text" value="<?=$data->getFirstName();?>" name="first_name"/>
        </label>
    </div>
    <div>
        <label>Last Name:
            <input type="text" value="<?=$data->getLastName();?>" name="last_name"/>
        </label>
    </div>
    <div>
        <label>Born on:
            <input type="text" value="<?=$data->getBornOn();?>" name="born_on"/>
        </label>
    </div>
    <div>
        <input type="submit" name="edit" value="Edit"/>
    </div>
</form>
<p>You can <a href="logout.php">logout</a> or see <a href="all.php">all users</a>.</p>
