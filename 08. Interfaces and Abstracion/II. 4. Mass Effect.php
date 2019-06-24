<?php


class Game implements GameInterface
{
    /**
     * @var GalaxyInterface
     */
    private $galaxy;
    public function __construct(GalaxyInterface $galaxy)
    {
        $this->galaxy = $galaxy;
    }

    /**
     *
     */
    public function start()
    {
        $this->galaxy->addStarSystem(self::STAR_SYSTEM_ARTEMIS_TAU, new StarSystem(self::STAR_SYSTEM_ARTEMIS_TAU));
        $this->galaxy->addStarSystem(self::STAR_SYSTEM_SERPENT_NEBULA, new StarSystem(self::STAR_SYSTEM_SERPENT_NEBULA));
        $this->galaxy->addStarSystem(self::STAR_SYSTEM_HADES_GAMMA, new StarSystem(self::STAR_SYSTEM_HADES_GAMMA));
        $this->galaxy->addStarSystem(self::STAR_SYSTEM_KEPLER_VERGE, new StarSystem(self::STAR_SYSTEM_KEPLER_VERGE));
        $this->galaxy->getStarSystem(self::STAR_SYSTEM_ARTEMIS_TAU)
            ->addNeighbour(self::STAR_SYSTEM_SERPENT_NEBULA, 50)
            ->addNeighbour(self::STAR_SYSTEM_KEPLER_VERGE, 120);
        $this->galaxy->getStarSystem(self::STAR_SYSTEM_SERPENT_NEBULA)
            ->addNeighbour(self::STAR_SYSTEM_ARTEMIS_TAU, 50)
            ->addNeighbour(self::STAR_SYSTEM_HADES_GAMMA, 360);
        $this->galaxy->getStarSystem(self::STAR_SYSTEM_HADES_GAMMA)
            ->addNeighbour(self::STAR_SYSTEM_SERPENT_NEBULA, 360)
            ->addNeighbour(self::STAR_SYSTEM_KEPLER_VERGE, 145);
        $this->galaxy->getStarSystem(self::STAR_SYSTEM_KEPLER_VERGE)
            ->addNeighbour(self::STAR_SYSTEM_HADES_GAMMA, 145)
            ->addNeighbour(self::STAR_SYSTEM_ARTEMIS_TAU, 120);
        $commandString = readline();
        while ($commandString != "over")
        {
            $tokens = explode(" ", $commandString);
            $cmd = $tokens[0];
            $cmd = preg_replace_callback("/-[a-z]/", function($m) use($cmd) {
                $match = $m[0];
                $char = $match[1];
                $upperChar = strtoupper($char);
                return $upperChar;
            }, $cmd);
            $cmd = ucfirst($cmd);
            $cmd = $cmd . "Command";
            $cmdInstance = new $cmd($this->galaxy);

            try {
                /** @var $cmdInstance */
                $result = $cmdInstance->execute($tokens);
                echo $result . PHP_EOL;
            } catch (\Exception $e) {
                echo $e->getMessage() . PHP_EOL;
            }
            $commandString = readline();
        }
    }
}
class Galaxy implements GalaxyInterface
{
    /**
     * @var StarSystemInterface[]
     */
    private $starSystems = [];
    /**
     * @var ShipInterface[]
     */
    private $ships = [];
    public function getStarSystem($name): StarSystemInterface
    {
        return $this->starSystems[$name];
    }
    public function addStarSystem($name, StarSystemInterface $starSystem)
    {
        $this->starSystems[$name] = $starSystem;
    }
    public function shipExists($name): bool
    {
        return array_key_exists($name, $this->ships);
    }
    public function addShip(ShipInterface $ship)
    {
        $this->ships[$ship->getName()] = $ship;
    }
    public function getShip($name): ShipInterface
    {
        return $this->ships[$name];
    }
}
interface GalaxyInterface
{
    public function getStarSystem($name): StarSystemInterface;
    public function addStarSystem($name, StarSystemInterface $starSystem);
    public function shipExists($name): bool;
    public function addShip(ShipInterface $ship);
    public function getShip($name): ShipInterface;
}
interface GameInterface
{
    const STAR_SYSTEM_ARTEMIS_TAU = "Artemis-Tau";
    const STAR_SYSTEM_SERPENT_NEBULA = "Serpent-Nebula";
    const STAR_SYSTEM_HADES_GAMMA = "Hades-Gamma";
    const STAR_SYSTEM_KEPLER_VERGE = "Kepler-Verge";
    public function start();
}
interface StarSystemInterface
{
    public function addNeighbour($solarSystemName, $fuelNeeded): StarSystemInterface;
    public function getName();
    public function getShip($name): ShipInterface;
    public function addShip(ShipInterface $ship);
    public function travelTo($shipName, StarSystemInterface $starSystem);
}
interface ProjectileInterface
{
    public function attack(ShipInterface $ship);
    public function getAttack(): int;
}
interface ShipInterface
{
    public function getName(): string;
    public function getAttack(): int;
    public function getShields(): int;
    public function getHealth(): int;
    public function getFuel(): float;
    public function setName($name);
    public function setAttack(int $attack);
    public function setShields(int $shields);
    public function setHealth(int $health);
    public function setFuel(float $fuel);
    public function getStarSystem(): StarSystemInterface;
    public function jumpTo(StarSystemInterface $starSystem);
    public function attack(ShipInterface $ship);
    public function attackResponse(ProjectileInterface $projectile);
    public function fireProjectile(): ProjectileInterface;
    public function isAlive(): bool;
    public function __toString();
}
interface EnhancementInterface
{
    public function giveBonus(ShipInterface $ship);
}
abstract class ProjectileAbstract implements ProjectileInterface
{
    protected $damage;
    public function __construct($damage)
    {
        $this->damage = $damage;
    }
}
abstract class ShipAbstract implements ShipInterface
{
    protected $name;
    protected $attack;
    protected $health;
    protected $shields;
    protected $fuel;
    protected $starSystem;
    protected $enhancements;
    /**
     * ShipAbstract constructor.
     * @param int $health
     * @param int $shields
     * @param int $attack
     * @param float $fuel
     * @param string $name
     * @param StarSystemInterface $starSystem
     * @param EnhancementInterface[] $enhancements
     */
    public function __construct(
        int $health,
        int $shields,
        int $attack,
        float $fuel,
        string $name,
        StarSystemInterface $starSystem,
        $enhancements = []
    ) {
        $this->setHealth($health);
        $this->setShields($shields);
        $this->setAttack($attack);
        $this->setFuel($fuel);
        $this->setName($name);
        $this->jumpTo($starSystem);
        $this->addEnhancements($enhancements);
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getAttack(): int
    {
        return $this->attack;
    }
    public function setAttack(int $attack)
    {
        $this->attack = max(0, $attack);
    }
    public function getHealth(): int
    {
        return $this->health;
    }
    public function setHealth(int $health)
    {
        $this->health = max(0, $health);
    }
    public function getShields(): int
    {
        return $this->shields;
    }
    public function setShields(int $shields)
    {
        $this->shields = max(0, $shields);
    }
    public function getFuel(): float
    {
        return $this->fuel;
    }
    public function setFuel(float $fuel)
    {
        $this->fuel = max(0, $fuel);
    }
    public function getStarSystem(): StarSystemInterface
    {
        return $this->starSystem;
    }
    public function jumpTo(StarSystemInterface $starSystem)
    {
        $this->starSystem = $starSystem;
    }
    public function isAlive(): bool
    {
        return $this->getHealth() > 0;
    }
    /**
     * @param EnhancementInterface[] $enhancements
     */
    public function addEnhancements(array $enhancements = [])
    {
        foreach ($enhancements as $enhancement) {
            $enhancement->giveBonus($this);
            $this->enhancements[] = $enhancement;
        }
    }
    public function __toString()
    {
        $output = "";
        $output .= "--" . $this->getName() . ' - ' . basename(get_class($this)) . PHP_EOL;
        if (!$this->isAlive()) {
            $output .= "(Destroyed)";
            return $output;
        }
        $output .= "-Location: " . $this->getStarSystem()->getName() . PHP_EOL;
        $output .= "-Health: " . $this->getHealth() . PHP_EOL;
        $output .= "-Shields: " . $this->getShields() . PHP_EOL;
        $output .= "-Damage: " . $this->getAttack() . PHP_EOL;
        $output .= "-Fuel: " . number_format($this->getFuel(), 1) . PHP_EOL;
        $output .= "-Enhancements: ";
        if (count($this->enhancements) == 0) {
            $output .= "N/A" . PHP_EOL;
        } else {
            $output .= implode(" ", $this->enhancements) . PHP_EOL;
        }
        return $output;
    }
}
abstract class EnhancementAbstract implements EnhancementInterface
{
    public function __toString()
    {
        return basename(get_class($this));
    }
}
class StarSystem implements StarSystemInterface
{
    private $neighbours = [];
    private $name;
    /**
     * @var ShipInterface[]
     */
    private $ships = [];
    public function __construct($name)
    {
        $this->name = $name;
    }
    public function addNeighbour($solarSystemName, $fuelNeeded): StarSystemInterface
    {
        $this->neighbours[$solarSystemName] = $fuelNeeded;
        return $this;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getShip($name): ShipInterface
    {
        return $this->ships[$name];
    }
    public function addShip(ShipInterface $ship)
    {
        $name = $ship->getName();
        $this->ships[$name] = $ship;
    }
    public function travelTo($shipName, StarSystemInterface $starSystem)
    {
        $ship = $this->ships[$shipName];
        unset($this->ships[$shipName]);
        $fuelNeeded = $this->neighbours[$starSystem->getName()];
        $ship->setFuel(
            $ship->getFuel() - $fuelNeeded
        );
        $ship->jumpTo($starSystem);
        $starSystem->addShip($ship);
    }
}
class ShieldReaver extends ProjectileAbstract
{
    public function attack(ShipInterface $ship)
    {
        $ship->setShields(
            $ship->getShields() - ($this->getAttack() * 2)
        );
        $ship->attackResponse($this);
    }
    public function getAttack(): int
    {
        return $this->damage;
    }
}
class Laser extends ProjectileAbstract
{
    public function attack(ShipInterface $ship)
    {
        $damage = $this->damage;
        $this->damage = max(0, $this->damage - $ship->getShields());
        $ship->attackResponse($this);
        $ship->setShields($ship->getShields() - $damage);
    }
    public function getAttack(): int
    {
        return $this->damage;
    }
}
class PenetrationShell extends ProjectileAbstract
{
    public function attack(ShipInterface $ship)
    {
        $ship->attackResponse($this);
    }
    public function getAttack(): int
    {
        return $this->damage;
    }
}
class Cruiser extends ShipAbstract
{
    const DEFAULT_HEALTH = 100;
    const DEFAULT_SHIELDS = 100;
    const DEFAULT_ATTACK = 50;
    const DEFAULT_FUEL = 300;
    public function __construct(string $name, StarSystemInterface $starSystem, $enhancements = [])
    {
        parent::__construct(self::DEFAULT_HEALTH,
            self::DEFAULT_SHIELDS,
            self::DEFAULT_ATTACK,
            self::DEFAULT_FUEL,
            $name,
            $starSystem,
            $enhancements
        );
    }
    public function attack(ShipInterface $ship)
    {
        $this->fireProjectile()->attack($ship);
    }
    public function attackResponse(ProjectileInterface $projectile)
    {
        $this->setHealth(
            $this->getHealth() - $projectile->getAttack()
        );
    }
    public function fireProjectile(): ProjectileInterface
    {
        return new PenetrationShell($this->getAttack());
    }
}
class Dreadnought extends ShipAbstract
{
    const DEFAULT_HEALTH = 200;
    const DEFAULT_SHIELDS = 300;
    const DEFAULT_ATTACK = 150;
    const DEFAULT_FUEL = 700;
    const RESPOND_ATTACK_SHIELDS_BONUS = 50;
    public function __construct(string $name, StarSystemInterface $starSystem, $enhancements = [])
    {
        parent::__construct(self::DEFAULT_HEALTH,
            self::DEFAULT_SHIELDS,
            self::DEFAULT_ATTACK,
            self::DEFAULT_FUEL,
            $name,
            $starSystem,
            $enhancements
        );
    }
    public function attack(ShipInterface $ship)
    {
        $this->fireProjectile()->attack($ship);
    }
    public function attackResponse(ProjectileInterface $projectile)
    {
        $this->setShields($this->getShields() + self::RESPOND_ATTACK_SHIELDS_BONUS);
        $this->setHealth(
            $this->getHealth() - $projectile->getAttack()
        );
        $this->setShields($this->getShields() - self::RESPOND_ATTACK_SHIELDS_BONUS);
    }
    public function fireProjectile(): ProjectileInterface
    {
        return new Laser(
            intval($this->getShields() / 2) + $this->getAttack()
        );
    }
}
class Frigate extends ShipAbstract
{
    const DEFAULT_HEALTH = 60;
    const DEFAULT_SHIELDS = 50;
    const DEFAULT_ATTACK = 30;
    const DEFAULT_FUEL = 220;
    private $firedProjectiles = 0;
    public function __construct(string $name, StarSystemInterface $starSystem, $enhancements = [])
    {
        parent::__construct(self::DEFAULT_HEALTH,
            self::DEFAULT_SHIELDS,
            self::DEFAULT_ATTACK,
            self::DEFAULT_FUEL,
            $name,
            $starSystem,
            $enhancements
        );
    }
    public function attack(ShipInterface $ship)
    {
        $this->fireProjectile()->attack($ship);
    }
    public function attackResponse(ProjectileInterface $projectile)
    {
        $this->setHealth(
            $this->getHealth() - $projectile->getAttack()
        );
    }
    public function fireProjectile(): ProjectileInterface
    {
        $this->firedProjectiles++;
        return new ShieldReaver($this->getAttack());
    }
    public function __toString()
    {
        $output = parent::__toString();
        if (!$this->isAlive()) {
            return $output;
        }
        $output .= "-Projectiles fired: " . $this->firedProjectiles . PHP_EOL;
        return $output;
    }
}
class ThanixCannon extends EnhancementAbstract
{
    const BONUS_ATTACK = 50;
    public function giveBonus(ShipInterface $ship)
    {
        $ship->setAttack($ship->getAttack() + self::BONUS_ATTACK);
    }
}
class ExtendedFuelCells extends EnhancementAbstract
{
    const BONUS_FUEL = 200;
    public function giveBonus(ShipInterface $ship)
    {
        $ship->setFuel($ship->getFuel() + self::BONUS_FUEL);
    }
}
class KineticBarrier extends EnhancementAbstract
{
    const BONUS_SHIELDS = 100;
    public function giveBonus(ShipInterface $ship)
    {
        $ship->setShields($ship->getShields() + self::BONUS_SHIELDS);
    }
}
interface Executable
{
    public function execute(array $args = []): string;
}
abstract class CommandAbstract implements Executable
{
    protected $galaxy;

    public function __construct(GalaxyInterface $galaxy)
    {
        $this->galaxy = $galaxy;
    }


}
class AttackCommand extends CommandAbstract
{

    public function execute(array $args = []): string
    {
        array_shift($args);
        $attackerName = array_shift($args);
        $defenderName = array_shift($args);

        $attacker = $this->galaxy->getShip($attackerName);
        $defender = $this->galaxy->getShip($defenderName);

        if (!$attacker->isAlive() || !$defender->isAlive()) {
            throw new \Exception("Ship is destroyed");
        }

        if ($attacker->getStarSystem() != $defender->getStarSystem()) {
            throw new \Exception("No such ship in star system");
        }

        $attacker->attack($defender);

        $output = "$attackerName attacked $defenderName";

        if (!$defender->isAlive()) {
            $output .= PHP_EOL . "$defenderName has been destroyed";
        }

        return $output;
    }
}
class CreateCommand extends CommandAbstract
{

    /**
     * @param array $args
     * @return string
     * @throws Exception
     */
    public function execute(array $args = []): string
    {
        array_shift($args);
        $shipType = array_shift($args);
        $shipFullType =  $shipType;
        $shipName = array_shift($args);

        if ($this->galaxy->shipExists($shipName)) {
            throw new \Exception("Ship with such name already exists");
        }

        $systemName = array_shift($args);
        $enhancements = [];
        foreach ($args as $enhancementName) {
            $fullName =  $enhancementName;
            $enhancement = new $fullName();
            $enhancements[] = $enhancement;
        }

        $starSystem = $this->galaxy->getStarSystem($systemName);
        $ship = new $shipFullType($shipName, $starSystem, $enhancements);

        $starSystem->addShip($ship);
        $this->galaxy->addShip($ship);

        return "Created $shipType $shipName";
    }
}
class PlotJumpCommand extends CommandAbstract
{

    public function execute(array $args = []): string
    {
        array_shift($args);
        $shipName = array_shift($args);
        $starSystemName = array_shift($args);

        $starSystem = $this->galaxy->getStarSystem($starSystemName);
        $ship = $this->galaxy->getShip($shipName);

        if (!$ship->isAlive()) {
            throw new \Exception('Ship is destroyed');
        }

        if ($ship->getStarSystem() === $starSystem) {
            throw new \Exception("Ship is already in $starSystemName");
        }

        $oldSystem = $ship->getStarSystem();

        $oldSystem->travelTo($shipName, $starSystem);

        return "$shipName jumped from {$oldSystem->getName()} to $starSystemName";
    }
}
class StatusReportCommand extends CommandAbstract
{

    public function execute(array $args = []): string
    {
        array_shift($args);
        $shipName = array_shift($args);
        $ship = $this->galaxy->getShip($shipName);

        return $ship . "";
    }
}
$game = new Game(new Galaxy());
$game->start();
