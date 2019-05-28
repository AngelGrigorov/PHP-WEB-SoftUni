<?php
$input = explode(" ", readline());
$sum = 0;
for($i = 0;$i < count($input);$i++){
    $sum += intval(strrev($input[$i]));
}
echo $sum;
