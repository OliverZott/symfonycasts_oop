<?php

class PdoShipStorage implements AbstractShipInterface
{
    // Dependency Injection for pdo object
    private PDO $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    /**
     * @return array
     */
    public function fetchAllShipsData()
    {
        $pdo = $this->pdo;
        $statement = $pdo->prepare('SELECT * FROM ship');
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * @param $id
     * @return mixed|null
     */
    public function fetchSingleShipData($id)
    {
        $pdo = $this->pdo;

        // prepare... normal query but prevents SQL injection attacks
        // https://stackoverflow.com/questions/60174/how-can-i-prevent-sql-injection-in-php

        $statement = $pdo->prepare('SELECT * FROM ship WHERE id = :id');
        $statement->execute(array('id' => $id));
        $shipArray = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$shipArray)
        {
            return null;
        }

        return $shipArray;
    }
}