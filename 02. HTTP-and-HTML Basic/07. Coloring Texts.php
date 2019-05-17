<?php
if (isset($_GET['input'])){
    $text = $_GET['input'];
    for($i = 0; $i < strlen($text); $i++){
        if($text[$i] != " "){
        if (ord($text[$i]) % 2 == 0) {
            $classValue = 'red';
        }else{
            $classValue = 'blue';
        }
        ?>
        <span style="color:<?php echo $classValue ?>">
               <?php echo $text[$i]; ?>
           </span>
          <?php
        }}}else{
        ?>
        <form>
            <textarea name="input"></textarea>
            <input type="submit" name="submit" value="Color text">
        </form>
    <?php
}
?>
