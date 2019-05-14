<?php
$input = strtolower(readline());
$alphabet = "abcdefghijklmnopqrstuvwxyz";
for($i = 0;$i < strlen($input);$i++){
    echo $input[$i] . " -> " . strpos($alphabet,$input[$i]).PHP_EOL;
}
