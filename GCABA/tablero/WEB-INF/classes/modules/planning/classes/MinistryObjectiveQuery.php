<?php



/**
 * Skeleton subclass for performing query and update operations on the 'planning_ministryObjective' table.
 *
 * Objetivos ministeriales
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class MinistryObjectiveQuery extends BaseMinistryObjectiveQuery {

 /**
	* Constructor con parametros de busqueda iniciales
	*
	*/
	public function __construct($dbName = 'application', $modelName = 'MinistryObjective', $modelAlias = null) {
		parent::__construct($dbName, $modelName, $modelAlias);
			$this->useImpactObjectiveQuery()
								->usePositionQuery()
									->filterByLastVersion()
									->orderByName()
								->endUse()
							->orderByInternalCode()
						->endUse()
						->orderByInternalCode();
	}

} // MinistryObjectiveQuery
