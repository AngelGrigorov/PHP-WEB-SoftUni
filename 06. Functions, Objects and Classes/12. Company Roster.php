<?php
class Employee{
    private $name;
    private $salary;
    private $position;
    private $department;
    private $email;
    private $age;

    /**
     * Employee constructor.
     * @param $name
     * @param $salary
     * @param $position
     * @param $department
     * @param $email
     * @param $age
     */
    public function __construct($name, $salary, $position, $department,$email,$age)
    {
        $this->name = $name;
        $this->salary = $salary;
        $this->position = $position;
        $this->department = $department;
        $this->email = $email;
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
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return mixed
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * @return null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return null
     */
    public function getAge()
    {
        return $this->age;
    }
public function __toString()
{
    if($this->getEmail() == NULL && $this->getAge() != NULL){
        $result = $this->getName().' '. sprintf('%0.2f', $this->getSalary()).' n/a ' . $this->getAge();
    }else if($this->getEmail() != NULL && $this->getAge() == NULL){
        $result = $this->getName().' '. sprintf('%0.2f', $this->getSalary()).' '. $this->getEmail(). ' -1';
    }else if ($this->getEmail() == NULL && $this->getAge() == NULL){
        $result = $this->getName().' '. sprintf('%0.2f', $this->getSalary()).' n/a '. '-1';
    }else{
        $result = $this->getName().' '. sprintf('%0.2f', $this->getSalary()).' '. $this->getEmail() . ' '. $this->getAge();

    }

return $result;
}
}
$n = readline();
$highestSalary = 0;
$highestDepartment = '';
$employees = [];
$departments = [];
for($i = 0;$i < $n;$i++){

   $employee = explode(' ',readline());
   $name = $employee[0];
   $salary = $employee[1];
   $position = $employee[2];
   $department = $employee[3];
$email = NULL;
$age = NULL;
    if(isset($employee[4]) && !isset($employee[5])){
        if(strpos($employee[4], '@') == false){
            $age = $employee[4];
            $email = NULL;
        }else{
            $email = $employee[4];
        }
    }
    if(isset($employee[4]) && isset($employee[5])){
        $email = $employee[4];
        $age = $employee[5];
    }
    $employees[] = new Employee($name,$salary,$position,$department,$email,$age);
    if(!isset($department,$departments)){

        $departments[$department] = $salary;
    }else{

        $departments[$department][] = $salary;


    }
}

foreach ($departments as $dep => $v){
    if($highestSalary < array_sum($v) / count($v)){
        $highestSalary = array_sum($v) / count($v);
        $highestDepartment = $dep;
    }
}
echo 'Highest Average Salary: ' . $highestDepartment . PHP_EOL;
usort($employees, function ($a, $b)
{
    return $b->getSalary() <=> $a->getSalary();
});


foreach ($employees as $em){
    if($em->getDepartment() == $highestDepartment){
echo $em . PHP_EOL;
    }
}


