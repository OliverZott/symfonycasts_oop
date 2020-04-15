<?php


class Container2
{

    // Service-Objects
    private static array $configuration;
    private static $pdo = null;
    private static $shipLoader = null;
    private static $shipStorage = null;
    private static $battleManager = null;


    // constructor using config file!
    public function __construct(array $config)
    {
        self::$configuration = $config;
    }


    /**
     * Function getting / creating "PDO" service-object
     * - ensuring only single pdo object exists
     * @return PDO
     */
    public static function getPDO()
    {
        if(self::$pdo === null)
        {
            self::$pdo = new PDO(
                self::$configuration['db_dsn'],
                self::$configuration['db_user'],
                self::$configuration['db_password']
            );
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }


    /**
     * Function getting / creating "ShipLoader" service-object
     * - Singleton
     * @return ShipLoader
     */
    public static function getShipLoader()
    {
        if(self::$shipLoader === null)
        {
            self::$shipLoader = new ShipLoader(self::getShipStorage());
        }
        return self::$shipLoader;
    }


    public static function getShipStorage()
    {
        if(self::$shipStorage === null)
        {
            self::$shipStorage = new PdoShipStorage(self::getPdo());
        }
        return self::$shipStorage;

    }

    /**
     * Function getting / creating "BattleManager" service-object
     * - Singleton
     * @return BattleManager|null
     */
    public static function getBattleManager()
    {
        if (self::$battleManager === null)
        {
            self::$battleManager = new BattleManager();
        }
        return self::$battleManager;
    }

}