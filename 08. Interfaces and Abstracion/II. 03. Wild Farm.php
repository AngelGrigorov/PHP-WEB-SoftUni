<?php
abstract class Food{
    private $quantity;
    public function getQuantity(){
        return $this->quantity;
    }
    public function setQuantity($quantity){
        $this->quantity = $quantity;
    }
    public function __construct($quantity)
    {
        $this->setQuantity($quantity);
    }
}
abstract class Animal{
    private $name;
    private $weight;
    private $type;
    private $foodEaten = 0;
    public $message =  "s are not eating that type of food!\n";
    public function getFoodEaten(){
        return $this->foodEaten;
    }
    public function setFoodEaten($quantity){
        $this->foodEaten += $quantity;
    }
    public function getType(){
        return  $this->type;
    }
    public function setType($type){
        $this->type = $type;
    }
    public function getWeight(){
        return $this->weight;
    }
    public function setWeight($weight){
        $this->weight = $weight;
    }
    public function getName(){
        return $this->name;
    }
    public function setName($name){
        $this->name = $name;
    }
    abstract public function eatableFood($food);
    abstract public function __toString();
    abstract public function makeSound();
    public function __construct($type,$name,$weight)
    {
        $this->setType($type);
        $this->setName($name);
        $this->setWeight($weight);
    }
}
abstract class Mammal extends Animal{
    private $livingRegion;
    public function getLivingRegion(){
        return $this->livingRegion;
    }
    public function setLivingRegion($region){
        $this->livingRegion = $region;
    }
    public function __construct($type,$name,$weight,$region)
    {
        parent::__construct($type,$name,$weight);
        $this->setLivingRegion($region);
    }
    public function __toString()
    {
        return $this->getType()
            ."["
            .$this->getName()
            .", "
            .$this->getWeight()
            .", "
            .$this->getLivingRegion()
            .", "
            .$this->getFoodEaten()
            ."]\n";
    }
}
abstract class Felime extends Mammal{
}
class Vegetable extends Food{
    public $type = "Vegetable";
}
class Meat extends Food{
    public $type = "Meat";
}
class Tiger extends Felime{
    public function makeSound()
    {
        echo "ROAAR!!!\n";
    }
    public function eatableFood($food)
    {
        if($food->type !="Meat"){
            echo $this->getType().$this->message;
        }else{
            $this->setFoodEaten($food->getQuantity());
        }
    }
}
class Cat extends Felime{
    private $breed;
    public function getBreed(){
        return $this->breed;
    }
    public function setBreed($breed){
        $this->breed = $breed;
    }
    public function makeSound()
    {
        echo "Meowwww\n";
    }
    public function eatableFood($food)
    {
        $this->setFoodEaten($food->getQuantity());
    }
    public function __construct($type, $name, $weight, $region,$breed)
    {
        parent::__construct($type, $name, $weight, $region);
        $this->setBreed($breed);
    }
    public function __toString()
    {
        return $this->getType()
            ."["
            .$this->getName()
            .", "
            .$this->getBreed()
            .", "
            .$this->getWeight()
            .", "
            .$this->getLivingRegion()
            .", "
            .$this->getFoodEaten()
            ."]\n";
    }
}
class Zebra extends Mammal{
    public function makeSound()
    {
        echo "Zs\n";
    }
    public function eatableFood($food)
    {
        if($food->type !="Vegetable"){
            echo $this->getType().$this->message;
        }else{
            $this->setFoodEaten($food->getQuantity());
        }
    }
}
class Mouse extends Zebra{
    public function makeSound()
    {
        echo "SQUEEEAAAK!\n";
    }
}
$classes = ["Tiger"=>Tiger::class,"Zebra"=>Zebra::class,"Mouse"=>Mouse::class,"Vegetable"=>Vegetable::class,"Meat"=>Meat::class];
while(true){
    $command = explode(" ",readline());
    if($command[0] =="End"){
        break;
    }
    $food  = explode(" ",readline());
    $food = new $classes[$food[0]]($food[1]);
    if(count($command)!=4){
        $animal = new Cat($command[0],$command[1],$command[2],$command[3],$command[4]);
        $animal->makeSound();
        $animal->eatableFood($food);
        echo $animal;
    }else{
        $animal = new $classes[$command[0]]($command[0],$command[1],$command[2],$command[3]);
        $animal->makeSound();
        $animal->eatableFood($food);
        echo $animal;
    }
}
