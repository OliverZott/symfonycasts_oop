<?php
/**
 * Class ShipLoader
 * Service Class to create Array of Ships
 * - Course 2 - Chapter 6, 7
 * - USE id instead of ship-name in index.php
 */


class ShipLoader
{

    // service class-property
    private AbstractShipInterface $shipStorage;

    /**
     * ShipLoader constructor  -->  DEPENDENCY INJECTION
     *
     * - service object is passed (injected) to a service class!
     * - configurable PDO service object is created outside of this service class!
     *
     * @param AbstractShipInterface $shipStorage
     */
    public function __construct(AbstractShipInterface $shipStorage)
    {
        $this->shipStorage = $shipStorage;
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
        $shipsFromDatabase = $this->shipStorage->fetchAllShipsData();

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
        $shipArray = $this->shipStorage->fetchSingleShipData($id);

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
}
