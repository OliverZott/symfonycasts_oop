<?php



class Container
{

    // Service-Objects
    private array $configuration;
    private $pdo = null;
    private static $shipLoader = null;
    private static $battleManager = null;


    // constructor using config file!
    public function __construct(array $config)
    {
        $this->configuration = $config;
    }


    /**
     * Function getting / creating "PDO service-object"
     * - ensuring only single pdo object exists
     *
     * @return PDO
     */
    public function getPDO()
    {
        if($this->pdo === null)
        {
            $this->pdo = new PDO(
                $this->configuration['db_dsn'],
                $this->configuration['db_user'],
                $this->configuration['db_password']
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $this->pdo;
    }


    /**
     * Function getting / creating "ShipLoader service-object"
     * @return ShipLoader
     */
    public function getShipLoader()
    {
        if(self::$shipLoader === null)
        {
            self::$shipLoader = new ShipLoader($this->getPDO());
        }
        return self::$shipLoader;
    }

}