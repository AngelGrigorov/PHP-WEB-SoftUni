<?php
interface Person
{
   public function setName($name);
   public function setAge($age);

}
class Citizen implements Person
{
private $name;
private $age;

    /**
     * Citizen constructor.
     * @param $name
     * @param $age
     */
    public function __construct($name, $age)
    {
        $this->setName($name);
        $this->setAge($age);
    }
    /**
     * @param mixed $name
     *
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age): void
    {
        $this->age = $age;
    }

public function __toString()
{
    return $this->name . PHP_EOL . $this->age;
}
}
$name = readline();
$age = readline();
$citizen = new Citizen($name,$age);
echo $citizen;

