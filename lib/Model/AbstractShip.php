<?php


abstract class AbstractShip
{
    // Attributes
    private int $id;
    private string $name = 'DefaultName';
    private int $weaponPower = 0;
    private  int $strength = 0;


    // Abstract functions
    abstract public function getJediFactor();

    abstract public function isFunctional();

    abstract public function getType();


    // Constructor
    public function __construct($name)
    {
        $this->name = $name;
    }


    public function getNameAndSpecs($useShortFormat = false)
    {

        if ($useShortFormat) {
            return sprintf(
                '%s: %s/%s/%s/%s',
                $this->name,
                $this->weaponPower,
                $this->getJediFactor(),
                $this->strength,
                $this->getType(),
            );
        }
        else {
            return sprintf(
                '%s: w:%s, j:%s, s:%s, t:%s',
                $this->name,
                $this->weaponPower,
                $this->getJediFactor(),
                $this->strength,
                $this->getType(),
            );
        }
    }


    // -----------------------------------------------------------------------------------------------------------------
    // Setter and Getter Functions
    /**
     * @return int
     */
    public function getWeaponPower(): int {
        return $this->weaponPower;
    }

    /**
     * @param int
     */
    public function setWeaponPower(int $weaponPower): void {
        $this->weaponPower = $weaponPower;
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