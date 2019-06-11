<?php
interface Charactable
{
    public function setUsername($username);
    public function getHashPassword();
    public function setLevel ($level);
    public function setSpecialPoints($specialPoints);

}

class Archangel implements Charactable
{
    public $username;

    public $level;
    public $specialPoints;
    public function __construct($username,$level,$specialPoints)
    {
        $this->setUsername($username);
        $this->setLevel($level);
        $this->setSpecialPoints($specialPoints);
    }
    public function __toString()
    {
        return '"'.$this->username.'" | "'.$this->getHashPassword().'" -> Archangel'."\n".intval($this->specialPoints*$this->level);
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getHashPassword()
    {
       return $this->hashPassword = strrev($this->username) . strlen($this->username)*21;
    }

    public function setLevel($level)
    {
        $this->level = $level;
    }

    public function setSpecialPoints($specialPoints)
    {
        $this->specialPoints = $specialPoints;
    }
}
class Demon implements Charactable
{
    public $username;
    public $level;
    public $specialPoints;
    public function __construct($username,$level,$specialPoints)
    {
        $this->setUsername($username);
        $this->setLevel($level);

        $this->setSpecialPoints($specialPoints);
    }
    public function __toString()
    {
        return '"'.$this->username.'" | "'.$this->getHashPassword().'" -> Demon'."\n".sprintf("%0.1f",round($this->specialPoints*$this->level,1));
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getHashPassword()
    {
        return $this->hashPassword = strlen($this->username)*217;
    }

    public function setLevel($level)
    {
        $this->level = $level;
    }

    public function setSpecialPoints($specialPoints)
    {
        $this->specialPoints = $specialPoints;
    }
}
$player = explode(" | ",readline());
if($player[1]=="Demon"){
    $player = new Demon($player[0],$player[2],$player[3]);
}else{
    $player = new Archangel($player[0],$player[2],$player[3]);
}
echo $player;
