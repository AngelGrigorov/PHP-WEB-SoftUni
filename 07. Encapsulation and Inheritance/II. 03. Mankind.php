<?php
class Human
{
    private $firstName;
    private $secondName;

    /**
     * Human constructor.
     * @param $firstName
     * @param $secondName
     * @throws Exception
     */
    public function __construct($firstName, $secondName)
    {
        $this->setFirstName($firstName);
        $this->setLastName($secondName);
    }

    public function getFirstName()
    {
        return $this->firstName;
    }
    public function getLastName()
    {
        return $this->secondName;
    }

    /**
     * @param string $firstName
     * @throws Exception
     */
    protected function setFirstName(string $firstName)
    {
        if (!ctype_upper($firstName[0])) {
            throw new \Exception("Expected upper case letter!Argument: firstName");
        }
        if (strlen($firstName) < 4) {
            throw new \Exception("Expected length at least 4 symbols!Argument: firstName");
        }
        $this->firstName = $firstName;
    }

    /**
     * @param string $secondName
     * @throws Exception
     */
    protected function setLastName(string $secondName)
    {
        if (!ctype_upper($secondName[0])) {
            throw new \Exception("Expected upper case letter!Argument: lastName");
        }
        if (strlen($secondName) < 3) {
            throw new \Exception("Expected length at least 3 symbols!Argument: lastName");
        }
        $this->secondName = $secondName;
    }
    public function __toString()
    {
        $print = "First Name: " . $this->getFirstName() . PHP_EOL
            . 'Last Name: ' . $this->getLastName() . PHP_EOL;;
        return $print;
    }
}
class Student extends Human
{
    private $facultyNumber;
    public function __construct(string $firstName, string $secondName, string $facultyNumber)
    {
        parent::__construct($firstName, $secondName);
        $this->setFacultyNumber($facultyNumber);
    }
    // Getters
    public function getFacultyNumber()
    {
        return $this->facultyNumber;
    }
    //Setters

    /**
     * @param string $facultyNumber
     * @throws Exception
     */
    protected function setFacultyNumber(string $facultyNumber)
    {
        if(is_numeric($facultyNumber)){
            if (strlen($facultyNumber) < 5 Xor strlen($facultyNumber) > 10) {
                throw new \Exception("Invalid faculty number!");
            }
        }
        $this->facultyNumber = $facultyNumber;
    }
    public function __toString()
    {
        return parent::__toString()
            . 'Faculty number: ' . $this->getFacultyNumber()
            . PHP_EOL;
    }
}
class Worker extends Human
{
    private $salaryPerWeek;
    private $workingHours;
    private $salaryPerHour;
    public function __construct(string $firstName, string $secondName, float $salaryPerWeek, float $workingHours)
    {
        parent::__construct($firstName, $secondName);
        $this->setSalaryPerWeek($salaryPerWeek);
        $this->setWorkingHours($workingHours);
        $this->setSalaryPerHour();
    }
    //Setters

    /**
     * @param float $salaryPerWeek
     * @throws Exception
     */
    protected function setSalaryPerWeek(float $salaryPerWeek)
    {
        if ($salaryPerWeek <= 10) {
            throw new \Exception("Expected value mismatch!Argument: weekSalary");
        }
        $this->salaryPerWeek = $salaryPerWeek;
    }

    /**
     * @param float $workingHours
     * @throws Exception
     */
    protected function setWorkingHours(float $workingHours)
    {
        if($workingHours < 1 || $workingHours > 12){
            throw new \Exception("Expected value mismatch!Argument: workHoursPerDay");
        }
        $this->workingHours = $workingHours;
    }
    protected function setSalaryPerHour()
    {
        $daysPerWeek = 7;
        $x = $this->salaryPerWeek / ($daysPerWeek * $this->workingHours);
        $this->salaryPerHour = $x;
    }
    protected function setLastName(string $secondName)
    {
        if (strlen($secondName) <= 3) {
            throw new \Exception("Expected length more than 3 symbols!Argument: lastName");
        }
        parent::setLastName($secondName);
    }
    //Getters
    public function getSalaryPerWeek()
    {
        return number_format($this->salaryPerWeek, 2, '.', '');
    }
    public function getWorkingHours()
    {
        return number_format($this->workingHours, 2, '.', '');
    }
    public function getSalaryPerHour()
    {
        return number_format($this->salaryPerHour, 2, '.', '');
    }
    public function __toString()
    {
        return parent::__toString() . 'Week Salary: ' . $this->getSalaryPerWeek() . PHP_EOL
            . 'Hours per day: ' . $this->getWorkingHours() . PHP_EOL
            . 'Salary per hour: ' . $this->getSalaryPerHour() . PHP_EOL;
    }
}
try {
   list($studentFirstName,$studentLastName,$facultyNumber) = explode(" ", readline());
    $newStudent = new Student($studentFirstName, $studentLastName, $facultyNumber);
    list($workerFirstName,$workerLastName,$salary,$workingHours) = explode(" ", readline());
    $newWorker = new Worker($workerFirstName, $workerLastName, $salary, $workingHours);
    echo $newStudent . PHP_EOL;
    echo $newWorker;
} catch (\Exception $e) {
    echo $e->getMessage();
}
