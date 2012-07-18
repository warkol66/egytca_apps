<?php



/**
 * Skeleton subclass for representing a row from the 'planning_activity' table.
 *
 * Actividades de las obras y proyectos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class PlanningActivity extends BasePlanningActivity {

	/**
	 * Devuelve las actividades
	 * @return array Relacion las actividades
	 */
	public function getPlanningProject() {
		return BaseQuery::create('Planning'.$this->getObjecttype())->findOneById($this->getObjectid());
	}

} // PlanningActivity
