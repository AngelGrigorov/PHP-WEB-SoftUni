<?php
$n = readline();
$k = readline();
$numbers = [];
$numbers[0] = 1;
        for ($i = 1; $i < $n; $i++) {
    for ($a = 0; $a < $k; $a++) {
        if($i < $k){
            for ($b = 1; $b <= $i; $b++) {
                $numbers[$i] += $numbers[$i-$b];
            }
                    break;
                } else {
            for ($c = 0; $c < $k; $c++){
                $numbers[$i] += $numbers[$i-$c- 1];
            }
                    break;
                }
    }
        }

        echo implode(" ",$numbers);




