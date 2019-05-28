<?php
$input = explode(' ',readLine());

 $count = count($input);
while ($count > 1)
{
    for ($i = 0; $i < $count - 1; $i++) {
        $input[$i] = $input[$i] + $input[$i + 1];
    }
    $count--;
}
echo $input[0];
