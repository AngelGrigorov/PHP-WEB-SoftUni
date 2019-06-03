<?php

class Number{
    private $num;

    /**
     * Number constructor.
     * @param $num
     */
    public function __construct($num)
    {
        $this->num = $num;
    }

    /**
     * @return mixed
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * @param mixed $num
     */
    public function setNum($num): void
    {
        $this->num = $num;
    }

    /**
     * @param $n
     * @return string
     */
    public function lastDig($n) : string {
        $lastDig = $n[strlen($n)-1];

        switch ($lastDig){
            case 1: $result =  'one';break;
            case 2: $result =  'two';break;
            case 3: $result =  'three';break;
            case 4: $result =  'four';break;
            case 5: $result =  'five';break;
            case 6: $result =  'six';break;
            case 7: $result =  'seven';break;
            case 8: $result =  'eight';break;
            case 9: $result =  'nine';break;
            case 0: $result =  'zero';break;
        }
    return $result;
    }
public function __toString()
{

    return $this->lastDig($this->getNum());
}
}
$input = readline();
$number = new Number($input);
echo $number;
