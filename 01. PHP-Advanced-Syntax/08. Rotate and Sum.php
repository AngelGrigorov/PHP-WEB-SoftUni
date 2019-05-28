<?php
$n = explode(" ", readline());
$rotations = readline();
$array = [];
$sum = [];
$sum = array_fill(0,count($n)-1,0);
for($i = 0; $i < $rotations;$i++){
    array_unshift($n,$n[count($n) - 1]);
    unset($n[count($n)-1]);
    $array[] = $n;
}
for($i = 0; $i< count($array);$i++){
    for($j = 0;$j< count($n);$j++){
        $sum[$j] += $array[$i][$j];
    }
}

echo implode(" ",$sum);
