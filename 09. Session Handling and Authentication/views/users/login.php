<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<h1>Login form</h1>
<div id="error" style="color:red">
    <h1><?=$error;?></h1>
</div>
<form method="post">
    Username: <input type="text" name="username"><br/>
    Password: <input type="password" name="password"><br/>
    <input type="submit" name="login" value="Login!"/>
</form>
</body>
</html>