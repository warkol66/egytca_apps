<?php



/**
 * Skeleton subclass for performing query and update operations on the 'planning_activity' table.
 *
 * Actividades de las obras y proyectos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class PlanningActivityQuery extends BasePlanningActivityQuery {
	
	protected function preSelect(\PropelPDO $con) {
		parent::preSelect($con);
		$this->orderById();
	}

 /**
	* Agrega filtros por fecha de vencimiento de la actividad
	*
	* @param   type array $range array con rango de fechas
	* @return condicion de filtrado por rango de fecha de vencimiento
	*/
	public function rangeExpiring($range) {
		return $this->filterByEndingdate($range);
	}

 /**
	* Agrega filtros por fecha de inicio de la actividad
	*
	* @param   type array $range array con rango de fechas
	* @return condicion de filtrado por rango de fecha de vencimiento
	*/
	public function rangeStarting($range) {
		return $this->filterByStartingdate($range);
	}

} // PlanningActivityQuery
