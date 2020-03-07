<?php

class Ship {

    private string $name = 'DefaultName';
    public int $weaponPower = 0;
    public int $jediPower = 0;
    public int $strength = 0;

    public function sayHello(){
        echo 'Hello';
    }

    public function getName() {
        return $this->name;
    }

    public function setName(String $set_name) {
        $this->name = $set_name;
    }

    public function getNameAndSpecs($useShortFormat = false){
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

