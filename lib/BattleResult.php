<?php

class BattleResult
{

    private bool $usedJediPowers;
    private $winningShip;  // null OR String
    private $losingShip;  // null OR String

    // Data wrapper
    public function __construct(bool $usedJediPowers, Ship $winningShip = null, Ship $losingShip = null)
    {
        $this->usedJediPowers = $usedJediPowers;
        $this->winningShip = $winningShip;
        $this->losingShip = $losingShip;
    }

    /**
     * @return bool
     */
    public function isUsedJediPowers(): bool
    {
        return $this->usedJediPowers;
    }

    /**
     * @return Ship / null
     */
    public function getWinningShip()
    {
        return $this->winningShip;
    }

    /**
     * @return Ship / null
     */
    public function getLosingShip()
    {
        return $this->losingShip;
    }


    public function isThereAWinner()
    {
        return $this->winningShip !== null;
    }


    /**
     * @return String
     */
    public function getWinningShipHealth()
    {
        return $this->winningShip->getStrength();
    }

}