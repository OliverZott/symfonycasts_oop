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

    // service class-property
    private PDO $pdo;



    /**
     * ShipLoader constructor.
     *
     * DEPENDENCY INJECTION
     * - service object is passed (injected) to a service class!
     * - configurable PDO service object is created outside of this service class!
     *
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    /**
     * Get an array of all Ship-Objects in database
     * (Course2 - Chapter6/7)
     *
     * - get Ships from Database (array)
     * - generate Ship Object from Database array (Ship)
     * - store all Ship objects in an array (array if Ships)
     *
     * @return AbstractShip[]
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
     * @return AbstractShip|null
     * @throws Exception
     */
    public function getShipById(int $id)
    {
        $pdo = $this->getPDO();

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
     * @return AbstractShip
     * @throws Exception
     */
    private function getShipFromData(array $shipFromDatabase)
    {

        if ($shipFromDatabase['team'] == 'rebel'){
            $ship = new RebelShip($shipFromDatabase['name']);
        } else {
            $ship = new Ship($shipFromDatabase['name']);
            $ship->setJediFactor($shipFromDatabase['jedi_factor']);

        }

        $ship->setId($shipFromDatabase['id']);
        $ship->setWeaponPower($shipFromDatabase['weapon_power']);
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


        $pdo = $this->getPDO();
        $statement = $pdo->prepare('SELECT * FROM ship');
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Function to return PDO object only ONCE!
     *
     * @return PDO
     */
    private function getPDO()
    {
        return $this->pdo;
    }

}
