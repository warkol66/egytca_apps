<?php



/**
 * Skeleton subclass for performing query and update operations on the 'planning_indicatorSerie' table.
 *
 * Series
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class PlanningIndicatorSeriePeer extends BasePlanningIndicatorSeriePeer {

    /**
     * Crea una serie nueva.
     *
     * @param array $variableParams array asociativo con los parametros de la serie
     * @param Connection $con [optional] Conexion a la db
     * @return boolean true si se creo el indicator correctamente, false sino
     */
    function create($serieParams) {
        $serieObj = new PlanningIndicatorSerie();
        foreach ($serieParams as $key => $value) {
            $setMethod = "set".$key;
            if ( method_exists($serieObj,$setMethod) ) {
                if (!empty($value) || $value == "0")
                    $serieObj->$setMethod($value);
                else
                    $serieObj->$setMethod(null);
            }
        }

        try {
            $serieObj->save();
            return $serieObj;
        } catch (PropelException $exp) {
            if (ConfigModule::get("global","showPropelExceptions"))
                print_r($exp->getMessage());
            return false;
        }
    }

    /**
     * Actualiza el orden de una serie.
     *
     * @param int $serieId ID de la serie
     * @param int $order nueva posicion de la serie en el ordenamiento
     * @return boolean true si pudo actualizar sino false
     */
    function updateOrder($serieId, $order) {
        try {
            $serie = self::retrieveByPK($serieId);
            $serie->setOrder($order);
            $serie->save();
            return true;
        } catch (PropelException $exp) {
            if (ConfigModule::get("global","showPropelExceptions"))
                print_r($exp->getMessage());
            return false;
        }
    }

} // PlanningIndicatorSeriePeer
