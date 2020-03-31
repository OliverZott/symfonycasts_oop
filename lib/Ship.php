<?php

class Ship {

    private int $id;
    private string $name = 'DefaultName';
    private int $weaponPower = 0;
    private int $jediPower = 0;
    private  int $strength = 0;
    private bool $underRepair;


    // Constructor
    public function __construct($name)
    {
        $this->name = $name;
        $this->underRepair = mt_rand(1,100) < 25;
    }

    public function isFunctional(): bool
    {
        return !$this->underRepair;
    }

    public function getNameAndSpecs($useShortFormat = false)
    {
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

    /* not used anymore ?!?!
    public function doesGivenShipHasMoreStrength($otherShip)
    {
        return $otherShip->weaponPower > $this->weaponPower ;
    }
    */

    // -----------------------------------------------------------------------------------------------------------------
    // Setter and Getter Functions
    /**
     * @return int
     */
    public function getWeaponPower(): int {
        return $this->weaponPower;
    }

    /**
     * @param int $weaponPower
     */
    public function setWeaponPower(int $weaponPower): void {
        $this->weaponPower = $weaponPower;
    }

    /**
     * @return int
     */
    public function getJediPower(): int {
        return $this->jediPower;
    }

    /**
     * @param int $jediPower
     */
    public function setJediPower(int $jediPower): void {
        $this->jediPower = $jediPower;
    }

    public function getName() {
        return $this->name;
    }

    public function setName(String $name) {
        $this->name = $name;
    }

    public function getStrength(): String {
        return $this->strength;
    }

    /* type check not necessary anymore (type hint forces error!)
    Better: set "int" at property declaration or type-hint in function!
    */
    public function setStrength($strength) {
        if (!is_numeric($strength)) {
            throw new Exception('WTF dude... Invalid strength argument passed' . $strength . gettype($strength));
        } else {
            $this->strength = $strength;
        }
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


}

