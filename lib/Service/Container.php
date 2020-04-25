<?php


use Battle\BattleManager;

class Container
{

    // Service-Objects
    private array $configuration;
    private $pdo = null;
    private $shipLoader = null;
    private $shipStorage = null;
    private static $battleManager = null;


    // constructor using config file!
    public function __construct(array $config)
    {
        $this->configuration = $config;
    }


    /**
     * Function getting / creating "PDO" service-object
     * - ensuring only single pdo object exists
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
     * Function getting / creating "ShipLoader" service-object
     * - Singleton
     * @return ShipLoader
     */
    public function getShipLoader()
    {
        if($this->shipLoader === null)
        {
            $this->shipLoader = new ShipLoader($this->getShipStorage());
        }
        return $this->shipLoader;
    }


    /**
     * @return  AbstractShipInterface|null
     */
    public function getShipStorage()
    {
        if($this->shipStorage === null)
        {
            // $this->shipStorage = new PdoShipStorage($this->getPDO());
            $this->shipStorage = new JsonFileShipStorage(__DIR__.'/../../resources/ships.json');
        }
        return $this->shipStorage;
    }

    /**
     * Function getting / creating "BattleManager" service-object
     * - Singleton
     * @return BattleManager|null
     */
    public function getBattleManager()
    {
        if (self::$battleManager === null)
        {
            self::$battleManager = new BattleManager();
        }
        return self::$battleManager;
    }

}