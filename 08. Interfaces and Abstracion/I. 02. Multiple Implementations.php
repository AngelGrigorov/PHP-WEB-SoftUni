<?php
interface Person
{
    public function setName($name);
    public function setAge($age);

}
interface Identifiable
{
    public function setId($id);
}
interface Birthable
{
    public function setBirthdate($birthDate);
}
class Citizen implements Person,Identifiable,Birthable
{
    private $name;
    private $age;
    private $id;
    private $birthDate;

    /**
     * Citizen constructor.
     * @param $name
     * @param $age
     * @param $id
     * @param $birthDate
     */
    public function __construct($name, $age,$id,$birthDate)
    {
        $this->setName($name);
        $this->setAge($age);
        $this->setId($id);
        $this->setBirthdate($birthDate);
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
        return $this->name . PHP_EOL . $this->age . PHP_EOL . $this->id . PHP_EOL. $this->birthDate;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setBirthdate($birthDate)
    {
        $this->birthDate = $birthDate;
    }
}
$name = readline();
$age = readline();
$id = readline();
$birthDate = readline();
$citizen = new Citizen($name,$age,$id,$birthDate);
echo $citizen;

