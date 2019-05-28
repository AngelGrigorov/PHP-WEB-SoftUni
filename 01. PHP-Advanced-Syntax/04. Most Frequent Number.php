<?php
$array = explode(" ", readline());
$most = [];
for($i = 0;$i < count($array);$i++){
    if(!key_exists($array[$i],$most)){
        $most[$array[$i]] = 1;
    }else{
        $most[$array[$i]] += 1;
    }
}
uksort($most, function ($key1, $key2) use($most){
return $most[$key2] <=> $most[$key1];
});

foreach($most as $keys => $v){
    echo $keys;
    return;
}
