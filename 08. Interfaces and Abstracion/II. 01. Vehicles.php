<?php
class Car{
    public $fuel;
    public $fuelPerKm;
    public function __construct($fuel,$fuelPerKm)
    {
        $this->fuel = $fuel;
        $this->fuelPerKm = $fuelPerKm+0.9;
    }
    public function getType(){
        return "Car";
    }
    public function drive($distance){
        if($distance*$this->fuelPerKm<=$this->fuel){
            echo $this->getType()." travelled ".(float)$distance." km\n";
            $this->fuel-=$distance*$this->fuelPerKm;
        }else{
            echo $this->getType()." needs refueling\n";
        }
    }
    public function refuel($fuel){
        $this->fuel+=$fuel;
    }
    public function __toString()
    {
        return $this->getType().": ".sprintf('%0.2f',round($this->fuel,2))."\n";
    }
}
class Truck extends Car{
    public function getType(){
        return "Truck";
    }
    public function __construct($fuel,$fuelPerKm)
    {
        parent::__construct($fuel,$fuelPerKm+0.7);
        $this->fuel = $fuel;
        $this->fuelPerKm = $fuelPerKm+1.6;
    }
    public function refuel($fuel){
        parent::refuel($fuel*0.95);
    }
}
$carInfo = explode(" ",readline());
$truckInfo = explode(" ",readline());
$car = new Car($carInfo[1],$carInfo[2]);
$truck = new Truck($truckInfo[1],$truckInfo[2]);
$n = readline();
for ($i=0;$i<$n;$i++){
    $command = explode(" ",readline());
    if($command[0] == "Drive"){
        if($command[1] == "Car"){
            $car->drive($command[2]);
        }else{
            $truck->drive($command[2]);
        }
    }else{
        if($command[1] == "Car"){
            $car->refuel($command[2]);
        }else{
            $truck->refuel($command[2]);
        }
    }
}
echo $car;
echo $truck;
