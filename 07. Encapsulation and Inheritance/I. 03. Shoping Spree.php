<?php
class Person {
    private $name;
    private $money;
    private $products = [];

    /**
     * Person constructor.
     * @param $name
     * @param $money
     * @throws Exception
     */
    public function __construct($name, $money)
    {
        $this->setName($name);
        $this->setMoney($money);
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
     * @throws Exception
     */
    public function setName($name): void
    {
        if($name==''){
            throw new Exception('Name cannot be empty');
        }
        $this->name = $name;
    }
    /**
     * @return mixed
     */
    public function getMoney()
    {
        return $this->money;
    }

    /**
     * @param mixed $money
     * @throws Exception
     */
    public function setMoney($money): void
    {
        if($money<0){
            throw new Exception('Money cannot be negative');
        }
        $this->money = $money;
    }
    public function getProducts()
    {
        if(count($this->products)==0){
            return ($this->getName().' - Nothing bought');
        }
        $proNames = [];
        foreach ($this->products as $p) {
            $proNames[] = $p->getName();
        }
        $pn = implode(',',$proNames);
        return ($this->getName().' - '.$pn);
    }

    /**
     * @param $product
     */
    public function setProducts($product): void
    {
        array_push($this->products,$product);
    }
}
class Product {
    private $name;
    private $cost;

    /**
     * Product constructor.
     * @param $name
     * @param $cost
     * @throws Exception
     */
    function __construct($name, $cost)
    {
        $this->setName($name);
        $this->setCost($cost);
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
     * @throws Exception
     */
    public function setName($name): void
    {
        if($name==''){
            throw new Exception('Name cannot be empty');
        }
        $this->name = $name;
    }
    /**
     * @return mixed
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param mixed $cost
     * @throws Exception
     */
    public function setCost($cost): void
    {
        if($cost<0){
            throw new Exception('Cost cannot be negative');
        }
        $this->cost = $cost;
    }
}
$personsInp = array_map('trim',explode(';',readline()));
array_pop($personsInp);
$persons = [];
$products = [];
try {
    foreach ($personsInp as $per) {
        list($name, $money) = array_map('trim', explode('=', $per));
        $persons[$name] = new Person($name, floatval($money));
    }
    $productsInp = array_map('trim',explode(';',readline()));
    array_pop($productsInp);
    foreach ($productsInp as $prod) {
        list($name, $cost) = explode('=', $prod);
        $products[$name] = new Product($name, floatval($cost));
    }
    $input = readline();
    while ($input!=="END"){
        list($per,$prod) = explode(' ',$input);
        if($persons[$per]->getMoney()>=$products[$prod]->getCost()){
            $persons[$per]->setProducts($products[$prod]);
            $persons[$per]->setMoney(($persons[$per]->getMoney())-($products[$prod]->getCost()));
            echo $persons[$per]->getName().' bought '.$products[$prod]->getName().PHP_EOL;
        } else {
            echo $persons[$per]->getName()." can't afford ".$products[$prod]->getName().PHP_EOL;
        }
        $input = readline();
    }
    foreach ($persons as $person) {
        echo $person->getProducts().PHP_EOL;
    }
} catch (Exception $e){
    echo $e->getMessage();
}
