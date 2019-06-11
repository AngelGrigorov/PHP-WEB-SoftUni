<?php
class Car{
    public $fuel = 0;
    public $fuelPerKm;
    public $tankCapacity;
    public function __construct($fuel,$fuelPerKm,$tankCapacity)
    {
        if($fuel<0){
            echo "Fuel must be a positive number\n";
            $this->fuel = 0;
        }elseif($fuel>$tankCapacity){
            echo "Cannot fit fuel in tank\n";
        }
        else {
            $this->fuel = $fuel;
        }
        $this->tankCapacity = $tankCapacity;
        $this->fuelPerKm = $fuelPerKm+0.9;
    }
    public function getType(){
        return "Car";
    }
    public function drive($distance){
        if($distance*$this->fuelPerKm <= $this->fuel){
            echo $this->getType()." travelled ".$distance." km\n";
            $this->fuel -= $distance*$this->fuelPerKm;
        }else{
            echo $this->getType()." needs refueling\n";
        }
    }
    public function refuel($fuel){
        if($this->fuel+$fuel>$this->tankCapacity){
            echo "Cannot fit fuel in tank\n";
        }else {
            $this->fuel += $fuel;
        }
    }
    public function __toString()
    {
        return $this->getType().": ".sprintf('%0.2f',$this->fuel)."\n";
    }
}
class Truck extends Car{
    /**
     * Truck constructor.
     * @param $fuel
     * @param $fuelPerKm
     * @param $tank
     */
    public function __construct($fuel, $fuelPerKm, $tank)
    {
        $this->fuel = $fuel;
        $this->fuelPerKm = $fuelPerKm+1.6;
        $this->tank = $tank;

    }
    public function getType(){
        return "Truck";
    }
    public function refuel($fuel){
        $this->fuel += $fuel*0.95;
    }
}
class Bus extends Car{
    public function getType(){
        return "Bus";
    }
    public function __construct($fuel,$fuelPerKm,$tanker)
    {
        parent::__construct($fuel,$fuelPerKm,$tanker);
        $this->fuelPerKm = $fuelPerKm;
    }
    public function driver($distance,$isEmpty){
        if($isEmpty){
            parent::drive($distance);
        }else{
            if($distance*($this->fuelPerKm+1.4)<=$this->fuel){
                echo $this->getType()." travelled ".$distance." km\n";
                $this->fuel -= $distance*($this->fuelPerKm+1.4);
            }else{
                echo $this->getType()." needs refueling\n";
            }
        }
    }
}
$carInfo = explode(" ",trim(fgets(STDIN)));
$truckInfo = explode(" ",trim(fgets(STDIN)));
$busInfo = explode(" ",trim(fgets(STDIN)));
$car = new Car($carInfo[1],$carInfo[2],$carInfo[3]);
$truck = new Truck($truckInfo[1], $truckInfo[2], $truckInfo[3]);
$bus = new Bus($busInfo[1],$busInfo[2],$busInfo[3]);
$n = trim(fgets(STDIN));
for ($i=0;$i<$n;$i++){
    $command = explode(" ",trim(fgets(STDIN)));
    if($command[0] == "Drive"){
        if($command[1] == "Car"){
            $car->drive($command[2]);
        }elseif($command[1] =="Truck"){
            $truck->drive($command[2]);
        }else{
            $bus->driver($command[2],false);
        }
    }elseif($command[0] == "Refuel"){
        if($command[1] == "Car"){
            $car->refuel($command[2]);
        }elseif($command[1] == "Truck"){
            $truck->refuel($command[2]);
        }else{
            $bus->refuel($command[2]);
        }
    }else{
        $bus->driver($command[2],true);
    }
}
echo $car;
echo $truck;
echo $bus;
