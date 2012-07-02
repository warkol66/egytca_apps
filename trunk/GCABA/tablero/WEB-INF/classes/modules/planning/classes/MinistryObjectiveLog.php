<?php



/**
 * Skeleton subclass for representing a row from the 'planning_ministryObjectiveLog' table.
 *
 * Objetivos ministeriales - Log
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class MinistryObjectiveLog extends BaseMinistryObjectiveLog {

	/**
	 * Devuelve un string con quien modifico el Objetivo Ministerial (MinistryObjective)
	 *
	 * @return string nombre del usuario que modifico el Objetivo Ministerial
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

	/**
	 * Devuelve true si el MinistryObjective tiene asociada la region,
	 * y false caso contrario.
	 * 
	 * @param Region $region
	 * @return boolean
	 */
	public function hasRegion($region) {
		return MinistryObjectiveRegionQuery::create()->filterByMinistryobjectiveid($this->getMinistryobjectiveid())->filterByRegion($region)->count() > 0;
	}

	/**
	 * Obtiene todas las versiones de un asunto a partir de su ministryObjectiveId ordenados por instante de creación y paginados.
	 *
	 * @param int $ministryObjectiveId id del objetivo ministerial.
	 * @param string $orderType forma en que se ordena, 'asc' = ascendente 'desc' = descendente.
	 * @return array versions correspondientes al asunto ordenados por instante de creación.
	 */
	public function getAllByMinistryObjective($ministryObjectiveId, $orderType = Criteria::ASC) {
		return $this->filterByMinistryobjectiveid($ministryObjectiveId)->orderByUpdatedAt($orderType);
	}

} // MinistryObjectiveLog
