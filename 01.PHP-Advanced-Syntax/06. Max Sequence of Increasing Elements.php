<?php
$array = explode(" ", readline());
$l = count($array);
$cntCurrSeq = 0;
$startCurrSeq = 0;
$cntMaxSeq = 0;
$startMaxSeq = 0;

for ($i = 1; $i < $l; $i++) {
                if ($array[$i] - $array[$i - 1] >= 1) {
                    $cntCurrSeq++;
                    $startCurrSeq = $i - $cntCurrSeq;

                    if ($cntCurrSeq > $cntMaxSeq) {
                        $cntMaxSeq = $cntCurrSeq;
                        $startMaxSeq = $startCurrSeq;
                    }
                }
                else {
                    $cntCurrSeq = 0;
                }
            }
            for ($iWrite = $startMaxSeq; $iWrite <= ($startMaxSeq + $cntMaxSeq); $iWrite++) {
                echo $array[$iWrite] . " ";
            }





