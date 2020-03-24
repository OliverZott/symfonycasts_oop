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


    /**
     * Get an array of all Ship-Objects in database
     * (Course2 - Chapter6/7)
     *
     * - get Ships from Database (array)
     * - generate Ship Object from Database array (Ship)
     * - store all Ship objects in an array (array if Ships)
     *
     * @return Ship[]
     * @throws Exception
     */
    public function getShips()
    {
        $shipsFromDatabase = $this->queryForShips();

        $ships = array();

        foreach ($shipsFromDatabase as $ship)
        {
            $ships[] = $this->getShipFromData($ship);
        }

        return $ships;

    }


    /**
     * @param int $id
     * @return Ship|null
     * @throws Exception
     */
    public function getShipById(int $id)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=oo_battle', 'root');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare... normal query but prevents SQL injection attacks
        // https://stackoverflow.com/questions/60174/how-can-i-prevent-sql-injection-in-php

        $statement = $pdo->prepare('SELECT * FROM ship WHERE id = :id');
        $statement->execute(array('id' => $id));
        $shipArray = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$shipArray)
        {
            return null;
        }

        return $this->getShipFromData($shipArray);
    }


    # --------------------------------------------- Private functions ---------------------------------------------

    /**
     * Converts array-object (from database) to Ship-Object
     *
     * @param array
     * @return Ship
     * @throws Exception
     */
    private function getShipFromData(array $shipFromDatabase)
    {
        $ship = new Ship($shipFromDatabase['name']);
        $ship->setId($shipFromDatabase['id']);
        $ship->setWeaponPower($shipFromDatabase['weapon_power']);
        $ship->setJediPower($shipFromDatabase['jedi_factor']);
        $ship->setStrength($shipFromDatabase['strength']);

        return $ship;
    }


    /**
     * Use Database for ShipLoader!
     * (Course 2 - Chapter 6)
     *
     * Idea: use "small private function" to have:
     *  - a proper name for code parts
     *  - easier reuse and maintain code
     *
     * @return array
     */
    private function queryForShips()
    {


        $pdo = new PDO('mysql:host=localhost;dbname=oo_battle', 'root');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $pdo->prepare('SELECT * FROM ship');
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }



}
