<?php
interface Buyer
{
    public function buyFood(): int;
    public function getFood(): int;
}
abstract class Human implements Buyer
{
    protected $name;
    protected $age;
    protected $food = 0;
    protected function __construct(string $name, int $age)
    {
        $this->name = $name;
        $this->age = $age;
    }
}
class Rabel extends Human
{
    private $group;
    public function __construct(string $name, int $age, string $group)
    {
        parent::__construct($name, $age);
        $this->group = $group;
    }
    public function buyFood(): int
    {
        return $this->food += 5;
    }
    public function getFood(): int
    {
        return $this->food;
    }
}
class Citizen extends Human
{
    private $id;
    private $birthDay;
    public function __construct(string $name, int $age, string $id, string $birthDay)
    {
        parent::__construct($name, $age);
        $this->id = $id;
        $this->birthDay = $birthDay;
    }
    public function buyFood(): int
    {
        return $this->food += 10;
    }
    public function getFood(): int
    {
        return $this->food;
    }
}
$array = [];
$counter = readline();
for ($i = 0; $i < $counter; $i++) {
    $input = readline();
    $tokens = explode(" ", $input);
    $name = $tokens[0];
    $age = intval($tokens[1]);
    if (count($tokens) == 4) {
        $id = $tokens[2];
        $birthDay = $tokens[3];
        $array[$name] = new Citizen($name, $age, $id, $birthDay);
    } else if (count($tokens) == 3) {
        $group = $tokens[2];
        $array[$name] = new Rabel($name, $age, $group);
    }
}
$amountOfFood = [];
while (true) {
    $nameToBeChecked = readline();
    if ($nameToBeChecked == "End") {
        break;
    }
    if (key_exists($nameToBeChecked, $array)) {
        $person = $array[$nameToBeChecked];
        $person->buyFood();
        $amountOfFood[$nameToBeChecked] = $person->getFood();
    }
}
echo array_sum($amountOfFood);
