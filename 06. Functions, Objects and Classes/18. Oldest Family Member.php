<?php
class Person{
    /** @var string */
    private $name;
    /** @var int */
    private $age;

    /**
     * Person constructor.
     * @param $name
     * @param $age
     */
    public function __construct(string $name, int $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

}
class Family{

    private $members;
    /** @var Person */
    private $oldestMember;

    /**
     * Family constructor.
     * @param $members
     * @param $oldestMember
     */
    public function __construct(array $members = NULL, Person $oldestMember = NULL)
    {
        $this->members = [];
        $this->oldestMember = NULL;
    }


    public function addMember( Person $person):void {
        if(NULL === $this->oldestMember || $this->oldestMember->getAge() < $person->getAge()){
            $this->oldestMember = $person;
        }
        $this->members[] = $person;
}
public function getOldestMember() : Person{
return $this->oldestMember;
}
}
$n = readline();
$family = new Family();
while($n--){
    list($name, $age) = explode(' ', readline());
    $person = new Person($name, $age);
    $family->addMember($person);
}
echo $family->getOldestMember()->getName() . ' ' . $family->getOldestMember()->getAge();
