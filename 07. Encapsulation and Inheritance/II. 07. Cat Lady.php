<?php
$cats = [];
while (($input = readline()) != "End") {
    list($a ,$name, $b ) = explode(" ", $input);
    $cats[$name] = $input;
}
$needle = readline();
echo $cats[$needle];
