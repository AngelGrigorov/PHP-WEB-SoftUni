<?php

interface idable
{
    public function setName($name);

    public function setId($id);

    public function getId();
}

class Person implements idable
{
    private $name;
    private $age;
    private $id;

    /**
     * Person constructor.
     * @param $name
     * @param $age
     * @param $id
     */
    public function __construct($name, $age, $id)
    {
        $this->setName($name);
        $this->setAge($age);
        $this->setId($id);
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
}

class Robot implements idable
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
    if (count($tokens) == 3) {
        $name = $tokens[0];
        $age = intval($tokens[1]);
        $id = $tokens[2];
        $arr[] = new Person($name, $age, $id);
    }
    if (count($tokens) == 2) {
        $model = $tokens[0];
        $id = $tokens[1];
        $arr[] = new Robot($model, $id);
    }
}
$num = readline();
$len = strlen($num) * -1;
foreach ($arr as $p) {
    if ($num == substr($p->getId(), $len)) {
        echo $p->getId() . PHP_EOL;
    }
}

