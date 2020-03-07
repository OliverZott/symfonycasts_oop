<?php

class Ship {

    public string $name = 'DefaultName';
    public int $weaponPower = 0;
    public int $jediPower = 0;
    public int $strength = 0;

    public function sayHello(){
        echo 'Hello';
    }

    public function getName() {
        return $this->name;
    }

    public function getNameAndSpecs($useShortFormat){
        if ($useShortFormat) {
            return sprintf(
                '%s: %s/%s/%s',
                $this->name,
                $this->weaponPower,
                $this->jediPower,
                $this->strength,
        );
        }
        else {
            return sprintf(
                '%s: w:%s, j:%s, s:%s',
                $this->name,
                $this->weaponPower,
                $this->jediPower,
                $this->strength,
        );
        }
    }

    public function doesGivenShipHasMoreStrength($otherShip) {
        return $otherShip->weaponPower > $this->weaponPower ;
    }
}

// Ship type hint in function to give hint what variable-type is!
function printShipSummary(Ship $someShip){
    echo 'My ships name: ' . $someShip->name;
    echo '<hr>';
    echo $someShip->sayHello();
    echo '<hr>';
    echo $someShip->getName();
    echo '<hr>';
    echo $someShip->getNameAndSpecs(false);
    echo '<hr>';
    echo $someShip->getNameAndSpecs(true);
    echo '<hr>';
}


$myShip1 = new Ship();
$myShip1->name = 'Jedi Starship';
$myShip1->weaponPower = 10;
$myShip1->strength = 51;


$myShip2 = new Ship();
$myShip2->name = 'Imperial Shuttle';
$myShip2->weaponPower = 5;
$myShip2->strength = 52;

printShipSummary($myShip1);
printShipSummary($myShip2);

if ($myShip1->doesGivenShipHasMoreStrength($myShip2)) {
    echo $myShip2->name . ' has more strength';
} else {
    echo $myShip1->name . ' has more strength';
}