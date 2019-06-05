<?php
class DecimalNumber{
    public $number;
    public function __construct($number)
    {
        $this->number = $number;
    }
    function printReverseNum($num){
        $num = strval($num);
        echo strrev($num);
    }
}
$input = new DecimalNumber(readline());
$input->printReverseNum($input->number);
