<?php



/**
 * Skeleton subclass for representing a row from the 'planning_indicatorSerie' table.
 *
 * Series
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class PlanningIndicatorSerie extends BasePlanningIndicatorSerie {

    /**
     * Obtiene el valor Y que corresponde a un valor X para la serie.
     * @param PlanningIndicatorX $x La x.
     *
     * @return valor Y para el valor X para la serie.
     */
    function getYForX($x) {
        $serieId = $this->getId();
        $xId = $x->getId();
        $y = PlanningIndicatorYQuery::create()
            ->filterBySerieid($serieId)
            ->filterByXid($xId)
            ->findOne();

        if ($y == NULL) {
            $y = new PlanningIndicatorY();
        }
        return $y;
    }

    /**
     * Obtiene los valores de la serie
     *
     * @return array de valores de la serie
     */
    function getYs() {
        // No podemos hacer una consulta a la DB porque puede tratarse
        // de un indicador no persistido.
        $serieYs = $this->getPlanningIndicatorYs();
        uasort($serieYs, array('IndicatorSerie', 'compareByOrder'));
        return $serieYs;
    }

    function compareByOrder($a, $b) {
        if ($a->getIndicatorX()->getOrder() == $b->getIndicatorX()->getOrder()) {
            return 0;
        }
        return ($a->getIndicatorX()->getOrder() < $b->getIndicatorX()->getOrder()) ? -1 : 1;
    }


} // PlanningIndicatorSerie
