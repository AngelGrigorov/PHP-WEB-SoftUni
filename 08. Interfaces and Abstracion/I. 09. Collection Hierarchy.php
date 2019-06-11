<?php
interface IAdd{
    public function add($data);
}
interface IRemove{
    public function remove($times);
}
class AddCollection implements IAdd{
    public $data;
    public $counter = 0;
    public function add($data)
    {
        $result ='' ;
        $myData = explode(" ",$data);
        foreach ($myData as $item){
            $result .=$this->counter." ";
            $this->counter++;
            $this->data[] = $item;
        }
        echo trim($result);
    }
}
class AddRemoveCollection implements IRemove{
    public $data=[];
    public function add($data){
        $result = '';
        $myData = explode(" ",$data);
        foreach ($myData as $item) {
            array_splice( $this->data, 0, 0, $item);
            $result .= "0 ";
        }
        echo trim($result);
    }
    public function remove($times)
    {
        $result = '';
        for ($i=0;$i<$times;$i++) {
            $count = count($this->data);
            $result .= $this->data[$count-1]." ";
            unset($this->data[$count-1]);
        }
        echo trim($result);
    }
}
class MyCollection implements IRemove,IAdd{
    public $data=[];
    public function remove($times)
    {
        $result = "";
        for ($i=0;$i<$times;$i++) {
            $result .=$this->data[0]." ";
            unset($this->data[0]);
            $this->data = array_values($this->data);
        }
        echo trim($result);
    }
    public function add($data)
    {
        $result = '';
        $myData = explode(" ",$data);
        foreach ($myData as $item){
            array_splice( $this->data, 0, 0, $item);
            $result .= "0 ";
        }
        echo trim($result);
    }
}
$data = trim(fgets(STDIN));
$timesRemove = trim(fgets(STDIN));
$addCollection = new AddCollection();
$addRemoveCollection = new AddRemoveCollection();
$myCollection = new MyCollection();
$addCollection->add($data);
echo "\n";
$addRemoveCollection->add($data);
echo "\n";
$myCollection->add($data);
echo "\n";
$addRemoveCollection->remove($timesRemove);
echo "\n";
$myCollection->remove($timesRemove);
