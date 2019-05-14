<?php
$input = readline();
$arr = [];
while($input !== 'END'){
    $input = explode(" ", $input);
    if($input[0] == "A"){
        $arr[$input[1]] = $input[2];
    }else if($input[0] == "S"){
        if(!key_exists($input[1],$arr)){
            echo "Contact $input[1] does not exist." . PHP_EOL;
        }else{
            $name = $input[1];
            echo "$name -> $arr[$name]  " . PHP_EOL;
        }
    }else if($input[0] == 'ListAll'){
        ksort($arr);
        foreach($arr as $names => $nums){
            echo "$names -> $nums  " . PHP_EOL;
        }
    }

    $input = readline();
}
