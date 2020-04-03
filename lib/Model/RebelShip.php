<?php

class RebelShip extends Ship
{

    public function getFavoriteJedi()
    {

        $coolJedi = array('Yoda', 'Ben Kenobi');
        $key = array_rand($coolJedi);

        return $coolJedi[$key];

    }

    public function getType(): string
    {
        return 'Rebel';
    }

    public function isFunctional(): bool
    {
        return true;
    }

}