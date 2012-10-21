<?php



/**
 * Skeleton subclass for performing query and update operations on the 'planning_indicatorX' table.
 *
 * Valores del eje x
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class PlanningIndicatorXPeer extends BasePlanningIndicatorXPeer {
    /**
     * Actualiza el orden de una X.
     *
     * @param int $xId ID de la X
     * @param int $order nueva posicion de la X en el ordenamiento
     * @return boolean true si pudo actualizar sino false
     */
    function updateOrder($xId, $order) {
        try {
            $x = PlanningIndicatorXQuery::create()->findPK($xId);
            $x->setOrder($order);
            $x->save();
            return true;
        } catch (PropelException $exp) {
            if (ConfigModule::get("global","showPropelExceptions"))
                print_r($exp->getMessage());
            return false;
        }
    }

} // PlanningIndicatorXPeer
