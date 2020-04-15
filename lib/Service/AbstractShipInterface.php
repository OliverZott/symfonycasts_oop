<?php


interface AbstractShipInterface
{

    /**
     * Returns an array of ship arrays, including: id, name, weaponPower, defense.
     *
     * @return array
     */
    public function fetchAllShipsData();


    /**
     * @param int $id
     * @return array[]
     */
    public function fetchSingleShipData($id);

}