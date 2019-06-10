<?php
class Person
{
    private $firstName;
    private $lastName;
    private $date;
    public $parents = [];
    public $children = [];
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }
    public function getChildren()
    {
        return $this->children;
    }
    public function setChildren($children)
    {
        $this->children[] = $children;
        usort($this->children, function($a,$b){
            return $a->appearance - $b->appearance;
        });
    }
    public function getParents()
    {
        return $this->parents;
    }
    public function setDate($date)
    {
        $this->date = $date;
    }
    public function setParents($parents)
    {
        $this->parents[] = $parents;
        usort($this->parents, function($a,$b){
            return $a->appearance - $b->appearance;
        });
    }
    public function getLastName()
    {
        return $this->lastName;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function getFirstName()
    {
        return $this->firstName;
    }
    function __construct($firstName,$lastName,$date)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->date = $date;
    }
    public function sort(){
        usort($this->children,'cmp');
        usort($this->parents,'cmp');
    }
}
class People{
    private $firstName;
    private $lastName;
    private $date;
    public $appearance = 0;
    public function getAppearance()
    {
        return $this->appearance;
    }
    public function getLastName()
    {
        return $this->lastName;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function getFirstName()
    {
        return $this->firstName;
    }
    public function setAppearance($appearance)
    {
        $this->appearance = $appearance;
    }
    function __construct($firstName, $lastName ,$birthDate)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->date = $birthDate;
    }
}
$family = array();
$person = explode(" ",trim(fgets(STDIN)));
$isName = false;
if(count(explode("/",$person[0]))==1){
    $person = new Person($person[0],$person[1],"date");
    $isName=true;
}else{
    $person = new Person("firstName","secondName",$person[0]);
    $isName=false;
}
$appearance = 1;
$input = array();
$people = trim(fgets(STDIN));
while($people != "End"){
    $input[] = $people;
    $people = trim(fgets(STDIN));
}
$count = count($input);
for ($i =0; $i<$count;$i++){
    $line = explode(" ",$input[$i]);
    if(count($line) == 3) {
        if(count(explode("/",$line[0])) == 1) {
            if($isName) {
                if ($person->getFirstName() == $line[0] && $person->getLastName() == $line[1]) {
                    $person->setDate($line[2]);
                } else {
                    $family[] = new People($line[0], $line[1], $line[2]);
                }
            }else{
                if($person->getDate()== $line[2]){
                    $person->setFirstName($line[0]);
                    $person->setLastName($line[1]);
                }else{
                    $family[] = new People($line[0], $line[1], $line[2]);
                }
            }
        }
    }
}
for  ($i=0; $i<$count;$i++){
    $line = explode(" ",$input[$i]);
    if(count(explode("/",$line[0]))==3){
        foreach ($family as $people){
            if($people->getDate()==$line[0] && $people->getAppearance() ==0){
                $people->setAppearance($appearance);
                $appearance++;
            }
        }
    }else{
        foreach ($family as $people){
            if(($people->getFirstName()==$line[0] && $people->getLastName()==$line[1]) && $people->getAppearance() ==0){
                $people->setAppearance($appearance);
                $appearance++;
            }
        }
    }
    if(count(explode("/",$line[count($line)-1]))==3){
        foreach ($family as $people){
            if($people->getDate()==$line[count($line)-1] && $people->getAppearance() ==0){
                $people->setAppearance($appearance);
                $appearance++;
            }
        }
    }else{
        foreach ($family as $people){
            if(($people->getFirstName()==$line[count($line)-1] &&$people->getLastName()==$line[count($line)-2])
                && $people->getAppearance() ==0){
                $people->setAppearance($appearance);
                $appearance++;
            }
        }
    }
}
for ($i =0; $i<$count;$i++){
    $line = explode(" ",$input[$i]);
    if(count($line) == 3) {
        if(count(explode("/",$line[0])) == 3) {
            if($person->getDate() == $line[0] || $person->getDate() == $line[2]){
                foreach ($family as $people){
                    if($people->getDate() == $line[2] ){
                        $person->setChildren($people);
                    }else if($people->getDate() == $line[0]){
                        $person->setParents($people);
                    }
                }
            }
        }
    }
    else if(count($line) == 4){
        if(count(explode("/",$line[0])) == 3) {
            if($person->getDate() == $line[0] ){
                foreach ($family as $people){
                    if($people->getFirstName() == $line[2] && $people->getLastName() == $line[3] ){
                        $person->setChildren($people);
                    }
                }
            }
            else if($person->getFirstName()==$line[2] && $person->getLastName()==$line[3]){
                foreach ($family as $people){
                    if($people->getDate() == $line[0]){
                        $person->setParents($people);
                    }
                }
            }
        }
        else if(count(explode("/",$line[3])) == 3){
            if($person->getDate() == $line[3] ){
                foreach ($family as $people){
                    if($people->getFirstName() == $line[0] && $people->getlastName() == $line[1] ){
                        $person->setParents($people);
                    }
                }
            }
            else if($person->getFirstName()==$line[0] && $person->getLastName()==$line[1]){
                foreach ($family as $people){
                    if($people->getDate == $line[3]){
                        $person->setChildren($people);
                    }
                }
            }
        }
    }
    else if(count($line)==5){
        if(($person->getFirstName()==$line[0] && $person->getLastName()==$line[1])
            || ($person->getFirstName()==$line[3] && $person->getLastName()==$line[4]) ){
            foreach ($family as $people){
                if($people->getFirstName() == $line[3] && $people->getLastName() == $line[4] ){
                    $person->setChildren($people);
                }else if($people->getFirstName() == $line[0] && $people->getLastName() == $line[1]){
                    $person->setParents($people);
                }
            }
        }
    }
}
$result = $person->getFirstName()." ".$person->getLastName()." ".$person->getDate()."\n";
$result .= "Parents:\n";
foreach($person->parents as $people){
    $result .= $people->getFirstName()." ".$people->getLastName()." ".$people->getDate()."\n";
}
$result .= "Children:\n";
foreach ($person->children as $people){
    $result .= $people->getFirstName()." ".$people->getLastName()." ".$people->getDate()."\n";
}
echo trim($result);
