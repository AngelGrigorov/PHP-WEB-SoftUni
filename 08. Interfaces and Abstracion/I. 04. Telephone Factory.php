<?php
interface Ringable
{
    public function setCall(string $number): string;
}
interface Browsable
{
    public function setBrowsing(string $url): string;
}
class SmartPhone implements Ringable, Browsable
{
    /**
     * @param string $number
     * @return string
     * @throws Exception
     */
    public function setCall(string $number): string
    {
        if (!is_numeric($number)) {
            throw new Exception("Invalid number!");
        }
        return "Calling... " . $number;
    }

    /**
     * @param string $site
     * @return string
     * @throws Exception
     */
    public function setBrowsing(string $site): string
    {
        if (preg_match('~[0-9]~', $site)) {
            throw new Exception("Invalid URL!");
        }
        return "Browsing: " . $site . "!";
    }
}

$phone_numbers = explode(" ", readline());
$sites = explode(" ", readline());
$phone = new SmartPhone();
foreach ($phone_numbers as $phoneNumber) {
    try {
        echo $phone->setCall($phoneNumber) . PHP_EOL;
    } catch (Exception $e) {
        echo $e->getMessage() . PHP_EOL;
    }
}
foreach ($sites as $website) {
    try {
        echo $phone->setBrowsing($website) . PHP_EOL;
    } catch (Exception $e) {
        echo $e->getMessage() . PHP_EOL;
    }
}
