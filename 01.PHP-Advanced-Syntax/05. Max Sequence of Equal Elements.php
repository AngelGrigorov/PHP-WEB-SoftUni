<?php
$array = explode(" ", readline());
$maxnumbers = 0;
        $count = 1;
        $maxcount = 1;
        $pos = 0;
        while ($pos < count($array) - 1) {

            if ($array[$pos] == $array[$pos + 1]) {
                $count++;

                if ($count > $maxcount) {
                    $maxcount = $count;
                    $maxnumbers = $array[$pos];
                }

            }
            else {
                $count = 1;
            }
            $pos++;
            if ($maxcount == 1) {
                $maxnumbers = $array[0];
            }
        }
        for ($i = 0; $i < $maxcount; $i++) {
            echo $maxnumbers . " ";

        }


