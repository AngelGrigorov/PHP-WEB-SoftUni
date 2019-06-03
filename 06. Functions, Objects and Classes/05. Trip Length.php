<?php
$input = readline();
shortestWay($input);
function shortestWay($input) {
list($x1,$y1,$x2,$y2,$x3,$y3) = explode(", ", $input);
    $distance12 = sqrt(pow(($x2 - $x1), 2) + pow(($y2 - $y1), 2));
    $distance23 = sqrt(pow(($x3 - $x2), 2) + pow(($y3 - $y2), 2));
    $distance13 = sqrt(pow(($x3 - $x1), 2) + pow(($y3 - $y1), 2));


    if (($distance12 <= $distance13) && ($distance13 >= $distance23)) {
        $a = $distance12 + $distance23;
        echo '1->2->3: ' . $a;
    }
    else if (($distance12 <= $distance23) && ($distance13 < $distance23)) {
        $b = $distance13 + $distance12;
        echo'2->1->3: ' . $b;
    }
    else {
        $c = $distance23 + $distance13;
        echo '1->3->2: ' . $c;
    }

}
