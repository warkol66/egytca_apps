<?php



/**
 * Skeleton subclass for representing a row from the 'planning_ministryObjective' table.
 *
 * Objetivos ministeriales
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class MinistryObjective extends BaseMinistryObjective {

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
	 * Devuelve las versiones para el asunto ordenadas en por fecha de creación y paginadas.
	 * @param string $orderType forma en que se ordena, Criteria::ASC = ascendente Criteria::DESC = descendente.
	 * @param int $page numero de pagina.
	 * @param int $maxPerPage cantidad maxima de elementos por pagina.
	 * @return array Versions para el proyecto ordenados en forma decreciente por fecha de creación.
	 */
	public function getVersionsOrderedByUpdatedPaginated($orderType = Criteria::ASC, $page=1, $maxPerPage=5) {
		$filters = array();		
		return BaseQuery::create('MinistryObjectiveLog')->getAllByMinistryObjective($this->getId(), $orderType)->createPager($filters, $page, $maxPerPage);
	}

	/**
	 * Devuelve true si el MinistryObjective tiene asociada la region,
	 * y false caso contrario.
	 * 
	 * @param Region $region
	 * @return boolean
	 */
	public function hasRegion($region) {
		return MinistryObjectiveRegionQuery::create()->filterByMinistryObjective($this)->filterByRegion($region)->count() > 0;
	}

	/**
	 * Devuelve array con posibles ejes de gestion (PolicyGuidelines)
	 *  id => ejes de gestion
	 *
	 * @return array ejes de gestion
	 */
	public static function getPolicyGuidelines() {
		$policyGuidelines = array(
			1 => 'Fortalecimiento de las políticas de promoción social, salud y educación',
			2 => 'Seguridad',
			3 => 'Movilidad sustentable'
		);
		return $policyGuidelines;
	}

} // MinistryObjective
