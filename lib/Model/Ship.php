<?php

class Ship extends AbstractShip {

    private bool $underRepair;
    private int $jediFactor = 0;


    // Constructor
    public function __construct($name)
    {
        parent::__construct($name);
        $this->underRepair = mt_rand(1,100) < 25;
    }


    // Abstract implementations
    public function isFunctional(): bool
    {
        return !$this->underRepair;
    }

    public function setJediFactor($factor)
    {
        $this->jediFactor = $factor;
    }

    /**
     * @inheritDoc
     */
    public function getJediFactor()
    {
        return $this->jediFactor;
    }


    private function getSecretDoorCodeToTheDeathStar()
    {
        return 'rainbows and unicorns';
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return 'Empire';
    }
}

