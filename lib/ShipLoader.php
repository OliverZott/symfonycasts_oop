<?php
/**
 * Class ShipLoader
 *
 * Service Class to create Ships
 */


class ShipLoader {

    public function getShips()
    {

        $ships = array();

        $ship = new Ship('Jedi Starfighter');
        $ship->setWeaponPower(5);
        $ship->setJediPower(15);
        $ship->setStrength(30);

        $ship2 = new Ship('CloakShape Fighter');
        $ship2->setWeaponPower(2);
        $ship2->setJediPower(2);
        // try catch cause exception in declaration
        try {
            $ship2->setStrength(70);
        } catch (Exception $e) {
        }

        $ship3 = new Ship('Super Star Destroyer');
        $ship3->setWeaponPower(70);
        $ship3->setJediPower(0);
        $ship3->setStrength(500);

        $ship4 = new Ship('RZ-1 A-wing interceptor');
        $ship4->setWeaponPower(4);
        $ship4->setJediPower(4);
        $ship4->setStrength(50);


        // without specific key:
        // $ships[] = $ship;

        $ships['starfighter'] = $ship;
        $ships['CloakShape Fighter'] = $ship2;
        $ships['Super Star Destroyer'] = $ship3;
        $ships['RZ-1 A-wing interceptor'] = $ship4;

        return $ships;

    }

}
