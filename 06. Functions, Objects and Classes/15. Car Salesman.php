<?php
class Car{
    public $model;
    public $engine;
    public $weight;
    public $color;
    public function __construct($model, $engine, $weight, $color)
    {
        $this->model = $model;
        $this->engine = $engine;
        $this->weight = $weight;
        $this->color = $color;
    }
    function __toString()
    {
        return $this->model.':'.PHP_EOL.'  '.$this->engine->model.':'.PHP_EOL
            .'    Power: '.$this->engine->power.PHP_EOL
            .'    Displacement: '.$this->engine->displacement.PHP_EOL
            .'    Efficiency: '.$this->engine->efficiency.PHP_EOL
            .'  Weight: '.$this->weight.PHP_EOL
            .'  Color: '.$this->color.PHP_EOL;
    }
}
class Engine{
    public $model;
    public $power;
    public $displacement;
    public $efficiency;
    public function __construct($model, $power, $displacement, $efficiency)
    {
        $this->model = $model;
        $this->power = $power;
        $this->displacement = $displacement;
        $this->efficiency = $efficiency;
    }
}
$engines = [];
$cars = [];
$numEng = intval(readline());
for ($i=0; $i< $numEng; $i++){
    $input = explode(' ',readline());
    if(count($input)===4){
        $engine = new Engine($input[0],$input[1],$input[2],$input[3]);
    } else if(count($input)===3){
        if(preg_match('/^[0-9]+$/',$input[2])){
            $engine = new Engine($input[0],$input[1],$input[2],'n/a');
        } else {
            $engine = new Engine($input[0],$input[1],'n/a',$input[2]);
        }
    } else {
        $engine = new Engine($input[0],$input[1],'n/a','n/a');
    }
    array_push($engines,$engine);
}
$numCars = intval(readline());
for ($i=0; $i<$numCars; $i++){
    $input = explode(' ',readline());
    $engine = '';
    foreach ($engines as $eng) {
        if($eng->model === $input[1]){
            $engine = $eng;
            break;
        }
    }
    if(count($input)===4){
        $car = new Car($input[0],$engine,$input[2],$input[3]);
    } else if(count($input)===3){
        if(preg_match('/^[0-9]+$/',$input[2])){
            $car = new Car($input[0],$engine,$input[2],'n/a');
        } else {
            $car = new Car($input[0],$engine,'n/a',$input[2]);
        }
    } else {
        $car = new Car($input[0],$engine,'n/a','n/a');
    }
    array_push($cars,$car);
}
foreach ($cars as $car) {
    echo $car->__toString();
}
