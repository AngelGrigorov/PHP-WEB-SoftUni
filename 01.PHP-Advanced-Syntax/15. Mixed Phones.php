<?php
$input = readline();
$arr = [];
while($input !== 'Over'){
    $input = explode(" : ", $input);
    if(is_numeric($input[0])){
        $arr[$input[1]] = $input[0];
    }else{
        $arr[$input[0]] = $input[1];

    }

    $input = readline();
}
ksort($arr);
foreach($arr as $names => $nums){
    echo "$names -> $nums  " . PHP_EOL;
}
