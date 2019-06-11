<?php

interface Idable
{
    public function setName($name);

    public function setId($id);

    public function getId();
}
interface Birthable
{
    public function setBirthdate($birthdate);

    public function getBirthdate();
}
class Pet implements Birthable
{
private $name;
private $birthdate;

    /**
     * Pet constructor.
     * @param $name
     * @param $birthdate
     */
    public function __construct($name, $birthdate)
    {
        $this->setName($name);
        $this->setBirthdate($birthdate);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }
}
class Person implements Idable, Birthable
{
    private $name;
    private $age;
    private $id;
    private $birthdate;

    /**
     * Person constructor.
     * @param $name
     * @param $age
     * @param $id
     * @param $birthdate
     */
    public function __construct($name, $age, $id,$birthdate)
    {
        $this->setName($name);
        $this->setAge($age);
        $this->setId($id);
        $this->setBirthdate($birthdate);
    }

    public function setAge($age)
    {
        $this->age = $age;

    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }
}

class Robot implements Idable
{
    private $name;
    private $id;
    public function __construct($name,$id)
    {
        $this->setName($name);
        $this->setId($id);
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}
$arr = [];
while (1) {
    $input = readline();
    if ($input == "End") {
        break;
    }
    $tokens = explode(" ", $input);
    if ($tokens[0] == 'Citizen') {
        $name = $tokens[1];
        $age = intval($tokens[2]);
        $id = intval($tokens[3]);
        $birthdate = $tokens[4];
        $arr[] = new Person($name, $age, $id, $birthdate);
    }
    else if ($tokens[0] == 'Robot') {
        continue;
    }
    else if($tokens[0] == 'Pet'){
        $name1 = $tokens[1];
        $birthdate1 = $tokens[2];
        $arr[] = new Pet($name1,$birthdate1);
    }
}
$year = readline();
$var = -4;
$anchor = false;
/** @var Person,Pet $p */
foreach ($arr as $p) {
    if (substr($year, $var) == substr($p->getBirthdate(), $var)) {
        echo $p->getBirthdate() . PHP_EOL;
        $anchor = true;
    }
}
if ($anchor == false) {
    echo "<no output>";
}

