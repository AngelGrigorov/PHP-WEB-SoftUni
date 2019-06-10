<?php
declare(strict_types = 1);
/**
 *
 */
class Animal
{
    private $type;
    private $name;
    private $age;
    private $gender;
    private $sound;
    public function __construct(string $name, int $age, string $gender, string $type = "animal")
    {
        $this->type = $type;
        $this->setName($name);
        $this->setAge($age);
        $this->setGender($gender);
        $this->setSound("Not implemented!");
    }
    protected function setSound(string $sound){
        if (empty($sound) || !isset($sound)) {
            throw new Exception("Invalid input!");
        }
        $this->sound = $sound;
    }
    protected function setName(string $name){
        if (empty($name) || !isset($name)) {
            throw new Exception("Invalid input!");
        }
        $this->name = $name;
    }
    protected function setAge(int $age){
        if (empty($age) || $age < 0 || !isset($age)) {
            throw new Exception("Invalid input!");
        }
        $this->age = $age;
    }
    protected function setGender(string $gender){
        if (empty($gender)) {
            throw new Exception("Invalid input!");
        }
        $this->gender = $gender;
    }
    public function produceSound(){
        return $this->sound;
    }
    public function __toString(){
        return "$this->type $this->name $this->age $this->gender";
    }
}
class Cat extends Animal
{
    public function __construct(string $name, int $age, string $gender, string $type = "Cat")
    {
        parent::__construct($name, $age, $gender, $type = "Cat");
        parent::setSound("MiauMiau");
    }
}
class Dog extends Animal
{
    public function __construct(string $name, int $age, string $gender, string $type = "Dog")
    {
        parent::__construct($name, $age, $gender, $type = "Dog");
        parent::setSound("BauBau");
    }
}
class Frog extends Animal
{
    public function __construct(string $name, int $age, string $gender, string $type = "Frog")
    {
        parent::__construct($name, $age, $gender, $type = "Frog");
        parent::setSound("Frogggg");
    }
}
class Kitten extends Cat
{
    public function __construct(string $name, int $age, string $gender = "female", string $type = "Kitten")
    {
        parent::__construct($name, $age, $gender, $type = "Kitten");
        parent::setSound("Miau");
    }
}
class Tomcat extends Cat
{
    public function __construct(string $name, int $age, string $gender = "male", string $type = "Tomcat")
    {
        parent::__construct($name, $age, $gender, $type = "Tomcat");
        parent::setSound("Give me one million b***h");
    }
}
while (($input = readline()) != "Beast!") {
    $type = $input;
    try{
        switch ($type) {
            case 'Cat':
                list($name, $age, $gender) = explode(" ", readline());
                $animal = new Cat($name, intval($age), $gender);
                break;
            case 'Frog':
                list($name, $age, $gender) = explode(" ", readline());
                $animal = new Frog($name, intval($age), $gender);
                break;
            case 'Dog':
                list($name, $age, $gender) = explode(" ", readline());
                $animal = new Dog($name, intval($age), $gender);
                break;
            case 'Kitten':
                list($name, $age, $a) = explode(" ", readline());
                $animal = new Kitten($name, intval($age));
                break;
            case 'Tomcat':
                list($name, $age, $a) = explode(" ", readline());
                $animal = new Tomcat($name, intval($age));
                break;
            default:
                throw new Exception("Invalid input!");
                break;
        }
        echo $animal.PHP_EOL;
        echo $animal->produceSound().PHP_EOL;
    } catch (Exception $e){
        echo $e->getMessage();
        return;
    }
}
