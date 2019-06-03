<?php
$input = readline();
$commands = explode(", ",readline());
foreach ($commands as $com){
    switch ($com){
        case 'chop':{
            echo chopNum($input) . PHP_EOL;
        } break;
        case 'dice':{
            echo dice($input) . PHP_EOL;
        } break;
        case 'spice':{
            echo spice($input) . PHP_EOL;
        } break;
        case 'bake':{
            echo bake($input) . PHP_EOL;
        } break;
        case 'fillet':{
            echo fillet($input) . PHP_EOL;
        } break;
    }
}

function chopNum(&$n){
    $n /= 2;
    return $n;
}
function dice(&$n){
    $n = sqrt($n);
    return $n;
}
function spice(&$n){
    $n += 1;
    return $n;
}
function bake(&$n){
    $n *= 3;
    return $n;
}
function fillet(&$n){
    $n *= 0.8;
    return $n;
}
