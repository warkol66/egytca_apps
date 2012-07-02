<?php



/**
 * Skeleton subclass for representing a row from the 'planning_constructionLog' table.
 *
 * Obras - Log
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class PlanningConstructionLog extends BasePlanningConstructionLog {

	/**
	 * Devuelve un string con quien modifico la obra (PlanningConstruction)
	 *
	 * @return string nombre del usuario que modifico la obra
	 */
	public function updatedBy() {
		if ($this->getUserobjecttype() != "") {
			$objectQueryName = $this->getUserobjecttype() . 'Query';
			if (class_exists($objectQueryName)) {
				$query = BaseQuery::create($this->getUserobjecttype());
				return $query->findPK($this->getUserobjectid());
			}
		}
		return;
	}

} // PlanningConstructionLog
