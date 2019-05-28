<?php
$stock = [];
$command = readline();

while($command != "shopping time") {
    list($action, $product, $quantity) = explode(' ', $command);
    $quantity = intval($quantity);
    if (key_exists($product, $stock)) {
        $stock[$product] += $quantity;
    } else {
        $stock[$product] = $quantity;
    }

    $command = readline();
 }
$command = readline();

while($command != "exam time") {
    list($action, $product, $quantity) = explode(' ', $command);
    $quantity = intval($quantity);
    if (key_exists($product, $stock)) {
        if ($stock[$product] <= 0) {
            echo "$product out of stock" . PHP_EOL;
        } else if ($stock[$product] < $quantity) {
            $stock[$product] = 0;
        } else {
            $stock[$product] -= $quantity;
        }

    } else {
        echo "$product doesn't exist" . PHP_EOL;
    }

    $command = readline();
}
foreach($stock as $product => $quantity){
    if($quantity > 0){
       echo "$product -> $quantity" . PHP_EOL;
    }
}
