<?php
class Mission
{
    private $codeName;
    private $state;
    public function __construct(?string $codeName, string $state = "inProgress")
    {
        $this->codeName = $codeName;
        $this->state = $state;
    }
    public function CompleteMission(){
        $this->state = "finished";
    }
    public function getCodeName(){
        return $this->codeName;
    }
    public function getMissionState(){
        return $this->state;
    }
}
class Soldier
{
    protected $id;
    protected $firstName;
    protected $lastName;

    public function __construct(?string $id, ?string $firstName, ?string $lastName)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }
    public function __toString(){
        return "Name: {$this->firstName} {$this->lastName} Id: {$this->id}";
    }
}
class Repair
{
    private $partName;
    private $hoursWorked;
    public function __construct(?string $partName, ?int $hoursWorked)
    {
        $this->partName = $partName;
        $this->hoursWorked = $hoursWorked;
    }
    public function getPartName(){
        return $this->partName;
    }
    public function getHours(){
        return $this->hoursWorked;
    }
}
class Privat extends Soldier
{
    protected $salary;
    public function __construct(?string $id, ?string $firstName, ?string $lastName, ?float $salary)
    {
        parent::__construct($id, $firstName, $lastName);
        $this->salary = $salary;
    }
    public function getId(){
        return $this->id;
    }
    public function __toString(){
        $output = parent::__toString();
        $salary = number_format($this->salary, 2, ".", "");
        $output .= " Salary: {$salary}";
        return $output;
    }
}
class Spy extends Soldier
{
    private $codeNumber;
    public function __construct(?string $id, ?string $firstName, ?string $lastName, ?int $codeNumber)	{
        parent::__construct($id, $firstName, $lastName);
        $this->codeNumber = $codeNumber;
    }
    public function __toString(){
        $output = parent::__toString().PHP_EOL;
        $output .= "Code Number: {$this->codeNumber}";
        return $output;
    }
}
class SpecialisedSoldier extends Privat
{
    private $corp;
    public function __construct(?string $id, ?string $firstName, ?string $lastName, ?float $salary, string $corp)	{
        parent::__construct($id, $firstName, $lastName, $salary);
        $this->corp = $corp;
    }
    public function __toString(){
        $salary = number_format($this->salary, 2, ".", "");
        return "Name: {$this->firstName} {$this->lastName} Id: {$this->id} Salary: {$salary}".PHP_EOL."Corps: {$this->corp}";
    }
}
class Commando extends SpecialisedSoldier
{
    private $missions = [];
    public function addMission(Mission $mission){
        $this->missions[] = $mission;
    }
    public function __toString(){
        $output = parent::__toString().PHP_EOL;
        $output .= "Missions:".PHP_EOL;
        foreach ($this->missions as $mission) {
            $output .= "  Code Name: {$mission->getCodeName()} State: {$mission->getMissionState()}".PHP_EOL;
        }
        return $output;
    }
}
class LeutenantGeneral extends Privat
{
    protected $privats;
    public function __construct(?string $id, ?string $firstName, ?string $lastName, ?float $salary)
    {
        parent::__construct($id, $firstName, $lastName, $salary);
        $this->privats = [];
    }
    public function addPrivate(Privat $private){
        $this->privats[] = $private;
    }
    public function __toString(){
        $output = parent::__toString().PHP_EOL;
        $output .= "Privates:".PHP_EOL;
        foreach ($this->privats as $privat) {
            $output .= "  ";
            $output .= $privat->__toString().PHP_EOL;
        }
        return $output;
    }
}
class Engineer extends SpecialisedSoldier
{
    private $setRepairs = [];
    public function addRepair(Repair $repair){
        $this->setRepairs[] = $repair;
    }
    public function __toString(){
        $output = parent::__toString().PHP_EOL;
        $output .= "Repairs:".PHP_EOL;
        foreach ($this->setRepairs as $repair) {
            $output .= " Part Name: {$repair->getPartName()} Hours Worked: {$repair->getHours()}".PHP_EOL;
        }
        return $output;
    }
}
$privates = [];
while (($input = readline(PHP_EOL)) != "End") {
    $input = explode(" ", $input);
    $soldierType = array_shift($input);
    try{
        switch ($soldierType) {
            case 'Private':
                [$id, $firstName, $lastName, $salary] = $input;
                $currentPrivate = new Privat($id, $firstName, $lastName, floatval($salary));
                echo $currentPrivate.PHP_EOL;
                $privates[] = $currentPrivate;
                break;
            case 'LeutenantGeneral':
                $id = array_shift($input);
                $firstName = array_shift($input);
                $lastName = array_shift($input);
                $salary = floatval(array_shift($input));
                $currentLeutenantGeneral = new LeutenantGeneral($id, $firstName, $lastName, $salary);
                $ownPrivatesId = $input;
                if ($ownPrivatesId) {
                    foreach ($ownPrivatesId as $id) {
                        foreach ($privates as $privat) {
                            if ($privat->getId() == $id) {
                                $currentLeutenantGeneral->addPrivate($privat);
                            }
                        }
                    }
                }
                echo $currentLeutenantGeneral;
                break;
            case 'Engineer':
                $id = array_shift($input);
                $firstName = array_shift($input);
                $lastName = array_shift($input);
                $salary = floatval(array_shift($input));
                $corp = array_shift($input);
                $repairs = $input;
                $currentEngineer = new Engineer($id, $firstName, $lastName, $salary, $corp);
                if ($repairs) {
                    for ($i=0; $i < count($repairs); $i += 2) {
                        $tool = $repairs[$i];
                        $hours = intval($repairs[$i + 1]);
                        $currentRepairSet = new Repair($tool, $hours);
                        $currentEngineer->addRepair($currentRepairSet);
                    }
                }
                echo $currentEngineer;
                break;
            case 'Commando':
                $id = array_shift($input);
                $firstName = array_shift($input);
                $lastName = array_shift($input);
                $salary = floatval(array_shift($input));
                $corp = array_shift($input);
                $missions = $input;
                $currentCommando = new Commando($id, $firstName, $lastName, $salary, $corp);
                if ($missions) {
                    for ($i=0; $i < count($missions); $i += 2) {
                        $missionName = $missions[$i];
                        $missionState = $missions[$i + 1];
                        if ($missionState == "finished" || $missionState == "inProgress") {
                            $currentMission = new Mission($missionName);

                            if ($missionState == "finished") {
                                $currentMission->CompleteMission();
                            }
                            $currentCommando->addMission($currentMission);
                        }
                    }
                }
                echo $currentCommando;
                break;
            case 'Spy':
                [$id, $firstName, $lastName, $codeNumber] = $input;
                $currentSpy = new Spy($id, $firstName, $lastName, intval($codeNumber));
                echo $currentSpy.PHP_EOL;
                break;
            default:
                // echo "Error!";
                break;
        }
    } catch (Exception $e){
    }
}
