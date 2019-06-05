<?php
$number = readline();
dnaHelix($number);
function dnaHelix($number) {
    $number = intval($number);
    $str = 'ATCGTTAGGG';
    $counter = 0;
    for($i=0; $i<$number; $i++) {
        if($i%4 == 0) {
            echo "**" . $str[$counter % 10] . $str[$counter % 10 + 1] . "**" . PHP_EOL;
        } else if($i%4 == 1) {
            echo "*" . $str[$counter % 10] .'--' . $str[$counter % 10 + 1] . "*" . PHP_EOL;
        } else if($i%4 == 2) {
            echo $str[$counter % 10] . '----' . $str[$counter % 10 + 1] . PHP_EOL;

        } else if($i%4 == 3) {
            echo "*" . $str[$counter % 10] .'--' . $str[$counter % 10 + 1] . "*" . PHP_EOL;


        }

        $counter += 2;
    }
}
