<form>
    <input type="text" name="name"></input></br>
    <input type="text" name="age"></input></br>
    <input type="radio" name="gender" value="male" placeholder="Male"></input>Male</br>
    <input type="radio" name="gender" value="female" placeholder="Female"></input>Female</br>
    <input type="submit"/>
</form>
<?php
if(isset($_GET['name']) && isset($_GET['age']) && isset($_GET['gender'])){
    $name = htmlspecialchars($_GET['name']);
    $gender = htmlspecialchars($_GET['gender']);
    $age = htmlspecialchars($_GET['age']);
    echo "My name is $name.I am $age years old.I am $gender.";
}
?>
