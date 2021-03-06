<?php
/**
 * Class BattleManager
 *
 * Service CLasses !!!
 */

namespace   Battle;

class BattleManager
{

    public const TYPE_NORMAL = 'normal';
    public const TYPE_NO_JEDI = 'no_jedi';
    public const TYPE_ONLY_JEDI = 'only_jedi';

    /**
     * Fighting algorithm:
     *
     * @param AbstractShip $ship1
     * @param $ship1Quantity
     * @param AbstractShip $ship2
     * @param $ship2Quantity
     * @param $battletype
     * @return BattleResult
     * @throws Exception
     */
    public function battle(AbstractShip $ship1, $ship1Quantity, AbstractShip $ship2, $ship2Quantity, $battletype) {
        $ship1Health = $ship1->getStrength() * $ship1Quantity;
        $ship2Health = $ship2->getStrength() * $ship2Quantity;

        $ship1UsedJediPowers = false;
        $ship2UsedJediPowers = false;
        while ($ship1Health > 0 && $ship2Health > 0) {
            // first, see if we have a rare Jedi hero event!
            if ($battletype != BattleManager::TYPE_NO_JEDI && $this->didJediDestroyShipUsingTheForce($ship1)) {
                $ship2Health = 0;
                $ship1UsedJediPowers = true;

                break;
            }
            if ($battletype != self::TYPE_NO_JEDI && $this->didJediDestroyShipUsingTheForce($ship2)) {
                $ship1Health = 0;
                $ship2UsedJediPowers = true;

                break;
            }

            // now battle them normally
            if ($battletype != self::TYPE_ONLY_JEDI) {
                $ship1Health = $ship1Health - ($ship2->getWeaponPower() * $ship2Quantity);
                $ship2Health = $ship2Health - ($ship1->getWeaponPower() * $ship1Quantity);
            }
        }


        /* Pass remaining health to according Ship-Instance
         *
         * - since "battle" function hast Ship-Object as argument -> call-by-reference
         *   so object-instance attribute can be changed here!
         */
        $ship1->setStrength($ship1Health);
        $ship2->setStrength($ship2Health);


        if ($ship1Health <= 0 && $ship2Health <= 0) {
            // they destroyed each other
            $winningShip = null;
            $losingShip = null;
            $usedJediPowers = $ship1UsedJediPowers || $ship2UsedJediPowers;
        } elseif ($ship1Health <= 0) {
            $winningShip = $ship2;
            $losingShip = $ship1;
            $usedJediPowers = $ship2UsedJediPowers;
        } else {
            $winningShip = $ship1;
            $losingShip = $ship2;
            $usedJediPowers = $ship1UsedJediPowers;
        }

        return new BattleResult($usedJediPowers, $winningShip, $losingShip);

        /* Old version with return array
        return array(
            'winning_ship' => $winningShip,
            'losing_ship' => $losingShip,
            'used_jedi_powers' => $usedJediPowers,
        );
        */
    }


    public static function getAllBattleTypesWithDescription()
    {
        return array(
            self::TYPE_NORMAL => 'Normal',
            self::TYPE_NO_JEDI => 'No Jedi Powers',
            self::TYPE_ONLY_JEDI => 'Only Jedi Powers',
        );
    }


    /**
     * private cause only used inside this class (battle function) !!!
     * (So you know it's only used in this class -> can't break stuff outside class)
     *
     * @param AbstractShip $ship
     * @return bool
     */
    private function didJediDestroyShipUsingTheForce(AbstractShip $ship)
    {
        $jediHeroProbability = $ship->getJediFactor()/ 100;

        return mt_rand(1, 100) <= ($jediHeroProbability*100);
    }
}