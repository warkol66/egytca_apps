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

	public function __construct($dbName = 'application', $modelName = 'PlanningActivity', $modelAlias = null) {
		parent::__construct($dbName, $modelName, $modelAlias);
			$this->orderById();
	}

} // PlanningActivityQuery