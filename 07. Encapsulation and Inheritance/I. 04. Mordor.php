<?php
$food = explode(",", readline());
$points = 0;
$counter = 0;
foreach ($food as $f) {
    $f = strtolower($f);
    if ($f == "cram") {
        $points += 2;
    } else if ($f == "lembas") {
        $points += 3;
    } else if ($f == "apple") {
        $points += 1;
    } else if ($f == "melon") {
        $points += 1;
    } else if ($f == "honeycake") {
        $points += 5;
    } else if ($f == "mushrooms") {
        $points += -10;
    } else {
        $counter -= 1;
    }
}
$totalSum = $points + $counter;
echo $totalSum . PHP_EOL;
$mood = "";
if ($totalSum < -5) {
    $mood = "Angry";
} else if ($totalSum >= -5 && $totalSum < 0) {
    $mood = "Sad";
} else if ($totalSum >= 0 && $totalSum < 15) {
    $mood = "Happy";
} else if ($totalSum > 15) {
    $mood = "PHP";
}
echo $mood;
