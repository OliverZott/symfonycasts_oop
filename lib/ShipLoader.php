<?php
/**
 * Class ShipLoader
 *
 * Service Class to create Array of Ships
 *
 * - Course 2 - Chapter 6, 7
 * - USE id instead of ship-name in index.php
 *
 */


class ShipLoader
{

    public function getShips()
    {
        /**
         * Course2 - Chapter6/7
         * - get Ships from Database
         * - generate Ship Object from Database array
         * - store all Ship objects in an array
         *
         */
        $shipsArray = $this->queryForShips();

        $ships = array();

        foreach ($shipsArray as $ship)
        {
            $shipData = new Ship($ship['name']);
            $shipData->setId($ship['id']);
            $shipData->setWeaponPower($ship['weapon_power']);
            $shipData->setJediPower($ship['jedi_factor']);
            $shipData->setStrength($ship['strength']);
            $ships[] = $shipData;
        }

        return $ships;

    }


    public function getShipById($id)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=oo_battle', 'root');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare... normal query but prevents SQL injection attacks
        // https://stackoverflow.com/questions/60174/how-can-i-prevent-sql-injection-in-php

        $statement = $pdo->prepare('SELECT * FROM ship WHERE id = :id');
        $statement->execute(array('id' => $id));
        $shipsArray = $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    private function queryForShips()
    {
        /**
         * Course 2 - Chapter 6
         * Use Database for ShipLoader!
         *
         * Idea: use "small private function" to have:
         *  - a proper name for code parts
         *  - easier reuse and maintain code
         */

        $pdo = new PDO('mysql:host=localhost;dbname=oo_battle', 'root');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $pdo->prepare('SELECT * FROM ship');
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

}
