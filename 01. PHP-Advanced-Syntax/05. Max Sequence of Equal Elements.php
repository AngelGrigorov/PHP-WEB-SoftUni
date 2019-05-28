<?php
$array = explode(" ", readline());
$maxNumbers = 0;
        $count = 1;
        $maxCount = 1;
        $pos = 0;
        while ($pos < count($array) - 1) {

            if ($array[$pos] == $array[$pos + 1]) {
                $count++;

                if ($count > $maxCount) {
                    $maxCount = $count;
                    $maxNumbers = $array[$pos];
                }

            }
            else {
                $count = 1;
            }
            $pos++;
            if ($maxCount == 1) {
                $maxNumbers = $array[0];
            }
        }
        for ($i = 0; $i < $maxCount; $i++) {
            echo $maxNumbers . " ";

        }


