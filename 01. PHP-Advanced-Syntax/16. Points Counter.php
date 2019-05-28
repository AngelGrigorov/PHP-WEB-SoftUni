<?php
$teamScore = array();
$teamInfo = array();
while(true) {
    $text = trim(fgets(STDIN  ));
    if ($text == "Result") {
        break;
    }
    $forbiden =  array("@", "%", "$", "*", "&");
    $cleanText = str_replace($forbiden, "", $text);

    $data = explode('|', $cleanText);

    if ($data[0] === strtoupper($data[0])) {
        $team = $data[0];
        $player = $data[1];
    } else {
        $team = $data[1];
        $player = $data[0];
    }

    $points = $data[2];
    $teamInfo[$team][$player] = $points;
    arsort($teamInfo[$team]);
}



foreach ($teamInfo as $key => $value) {

    if (!array_key_exists($key, $teamScore)){

        $teamScore[$key] = 0;
    }




    foreach($value as $k => $v) {

        $teamScore[$key] += $v;
    }
}

arsort($teamScore);

foreach ($teamScore as $key => $value) {

    echo $key . " => " . $value . "\n";
    echo "Most points scored by " . key($teamInfo[$key]) . "\n";
}

