<?php
class Tire
{
    public $pressure;
    public $age;
    public function __construct(float $pressure, int $age)
    {
        $this->pressure = $pressure;
        $this->age = $age;
    }
    function isRightPressure()
    {
        return $this->pressure < 1;
    }
}
class Cargo
{
    public $weight;
    public $type;
    public function __construct(int $weight, string $type)
    {
        $this->weight = $weight;
        $this->type = $type;
    }
}
class Car
{
    public $model;
    public $engine;
    public $cargo;
    public $tires;
    function __construct(string $model, Engine $engine, Cargo $cargo, array $tires)
    {
        $this->model = $model;
        $this->engine = $engine;
        $this->cargo = $cargo;
        $this->tires = $tires;
    }
}
class Engine
{
    public $speed;
    public $power;
    public function __construct(int $speed, int $power)
    {
        $this->speed = $speed;
        $this->power = $power;
    }
}
$carCount = intval(trim(readline()));
$cars = [];
for ($i = 0; $i < $carCount; $i++) {
    $input = explode(' ', trim(readline()));
    list($model, $engineSpeed, $enginePower, $cargoWeight, $cargoType,
        $tire1Pressure, $tire1Age,
        $tire2Pressure, $tire2Age,
        $tire3Pressure, $tire3Age,
        $tire4Pressure, $tire4Age) = $input;
    $engine = new Engine(intval($engineSpeed), intval($enginePower));
    $cargo = new Cargo(intval($cargoWeight), $cargoType);
    $tires = [new Tire(floatval($tire1Pressure), intval($tire1Age)), new Tire(floatval($tire2Pressure), intval($tire2Age)),
        new Tire(floatval($tire3Pressure), intval($tire3Age)), new Tire(floatval($tire4Pressure), intval($tire4Age))];
    $currentCar = new Car($model, $engine, $cargo, $tires);
    $cars[] = $currentCar;
}
$command = trim(readline());
if ($command === 'fragile') {
    foreach ($cars as $car) {
        if ($car->cargo->type === 'fragile') {
            foreach ($car->tires as $tire) {
                if ($tire->isRightPressure()) {
                    echo $car->model . "\n";
                    break;
                }
            }
        }
    }
} else if ($command === 'flamable') {
    foreach ($cars as $car) {
        if ($car->cargo->type === 'flamable') {
            if ($car->engine->power > 250) {
                echo $car->model . "\n";
            }
        }
    }
}
