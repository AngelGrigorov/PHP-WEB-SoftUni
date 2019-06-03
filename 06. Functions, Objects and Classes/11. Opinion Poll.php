<?php
class Person{
    public $name;
    public $age;

    /**
     * Person constructor.
     * @param $name string
     * @param $age int
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
public function __toString()
{
return $this->getName() .' - ' . $this->getAge();
}
}

$n = readline();
$people = [];
for ($i = 0;$i < $n;$i++){
    $p = readline();
    list($name, $age) = explode(' ',$p);
    if($age > 30) {
        $people[] = new Person($name, intval($age));
    }
}
usort($people, function ($a, $b)
{
    return $a->getName() <=> $b->getName();
});
foreach ($people as $person){
    echo $person . PHP_EOL;
}

