<?php
$input = readline();
$arr = [];
$count = 0;
while($input !== 'login'){
    $input = explode(" -> ", $input);
    $arr[$input[0]] = $input[1];
    $input = readline();
}
$input = readline();
while($input !== 'end'){
    $input = explode(" -> ", $input);
    if(key_exists($input[0],$arr) && $arr[$input[0]] == $input[1]){
echo "$input[0]: logged in successfully" . PHP_EOL;
    }else{
        echo "$input[0]: login failed" . PHP_EOL;
        $count++;
    }
    $input = readline();
}
echo "unsuccessful login attempts: $count";
