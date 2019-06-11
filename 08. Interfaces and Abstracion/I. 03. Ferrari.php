<?php
interface Car
{
    public function getModel();
    public function useBreaks();
    public function useGasPedal();
}
class Ferrari implements Car
{
    private $driverName;

    /**
     * Ferrari constructor.
     * @param $driverName
     */
    public function __construct($driverName)
    {
        $this->setDriverName($driverName);
    }
    /**
     * @param mixed $driverName
     */
    public function setDriverName($driverName): void
    {
        $this->driverName = $driverName;
    }
    /**
     * @return mixed
     */
    public function getDriverName()
    {
        return $this->driverName;
    }

    public function getModel()
    {
        return '488-Spider';
    }

    public function useBreaks()
    {
        return 'Brakes!';
    }

    public function useGasPedal()
    {
        return 'Zadu6avam sA!';
    }
    public function __toString()
    {
        return $this->getModel() . '/' . $this->useBreaks() .
            '/' . $this->useGasPedal() . '/' . $this->getDriverName();
    }
}
$name = readline();
$drive = new Ferrari($name);
echo $drive;
