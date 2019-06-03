<?php
$num = readline();
while(sum($num) / strlen($num) < 5){
$num .= 9;
}
echo $num;


function sum($num) {
    $sum = 0;
    for ($i = 0; $i < strlen($num); $i++){
        $sum += $num[$i];
    }
    return $sum;
}
