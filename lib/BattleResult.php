<?php

class BattleResult
{

    private bool $usedJediPowers;
    private  Ship $winningShip;  // null OR String
    private  Ship $losingShip;  // null OR String

    // Data wrapper
    public function __construct(bool $usedJediPowers, Ship $winningShip, Ship $losingShip)
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
     * @return Ship
     */
    public function getWinningShip(): Ship
    {
        return $this->winningShip;
    }

    /**
     * @return Ship
     */
    public function getLosingShip(): Ship
    {
        return $this->losingShip;
    }



}