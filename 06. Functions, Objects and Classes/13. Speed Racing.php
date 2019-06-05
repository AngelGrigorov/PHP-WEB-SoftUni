<?php
class Car
{
    public $model;
    public $fuel_amount;
    public $fuel_cost;
    public $distance_travelled = 0;
    public function __construct($model, $fuel_amount, $fuel_cost)
    {
        $this->model = $model;
        $this->fuel_amount = $fuel_amount;
        $this->fuel_cost = $fuel_cost;
    }
    public function __toString()
    {
        return "{$this->model} " . number_format(abs($this->fuel_amount), 2, '.', '') . " {$this->distance_travelled}" . PHP_EOL;
    }
    public function drive($distance)
    {
        $neededFuel = round($distance * $this->fuel_cost, 2);
        if (round($this->fuel_amount, 2) < $neededFuel) {
            echo "Insufficient fuel for the drive" . PHP_EOL;
            return;
        } else {
            $this->fuel_amount -= $neededFuel;
            $this->distance_travelled += $distance;
            return;
        }
    }
    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }
}
$n = intval(readline());
$cars = [];
for ($i = 1; $i <= $n; $i++) {
    list($carModel, $fuelAmount, $fuelCost) = explode(" ", trim(readline()));
    $cars[] = new Car($carModel, $fuelAmount, $fuelCost);
}
while (true) {
    $token = explode(" ", trim(readline()));
    if ($token[0] == "End") break;
    list($command, $carModel, $distance) = $token;
    foreach ($cars as $car) {
        if ($carModel == $car->model) {
            $car->drive($distance);
        }
    }
}
foreach ($cars as $car) {
    echo $car;
}
