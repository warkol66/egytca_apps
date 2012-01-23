<?php



/**
 * Skeleton subclass for performing query and update operations on the 'vialidad_supply' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.vialidad.classes
 */
class SupplyQuery extends BaseSupplyQuery {

	/**
	 * Permite agregar un filtro personalizado a la Query, que puede ser
	 * traducido al campo correspondiente.
	 * @param   type $filterName
	 * @param   type $filterValue
	 * @return  ModelCriteria
	 */
	public function addFilter($filterName, $filterValue) {

		$filterName = ucfirst($filterName);

		// empty() no sirve porque algunos filtros admiten 0 como valor
		if (!isset($filterValue) || $filterValue == null)
			return $this;

		switch ($filterName) {

			case 'SearchString':
				$this->filterByName("%$filterValue%", Criteria::LIKE);
				break;

			case 'GetCandidates':
				$this->filterById($filterValue, Criteria::NOT_IN);
				break;

			case 'EntityFilter':

				$entityQuery = ucfirst($filterValue['entityType']).'Query';
				if (!class_exists(ucfirst($filterValue['entityType'])) || !class_exists($entityQuery))
					break; // nothing to filter

				$entity = $entityQuery::create()->findOneById($filterValue['entityId']);

				$filterByEntity = 'filterBy'.ucfirst($filterValue['entityType']);
				
				if ($filterValue['getCandidates'])
					$comparison = Criteria::NOT_IN;
				else
					$comparison = Criteria::IN;
				
				$alreadyRelated = SupplyQuery::create()->select("Id")->$filterByEntity($entity)->find()->toArray();
				$this->filterById($alreadyRelated, $comparison);
				break;

			default:
				if (in_array($filterName, SupplyPeer::getFieldNames(BasePeer::TYPE_PHPNAME)))
					$this->filterBy($filterName, $filterValue);
				else {
					//Log - campo inexistente.
				}
				break;
		}
		return $this;
	}
    
    public function EntityFilter($filterValue) {
        $entityQuery = ucfirst($filterValue['entityType']).'Query';
        if (!class_exists(ucfirst($filterValue['entityType'])) || !class_exists($entityQuery))
            break; // nothing to filter

        $entity = $entityQuery::create()->findOneById($filterValue['entityId']);

        $filterByEntity = 'filterBy'.ucfirst($filterValue['entityType']);

        if ($filterValue['getCandidates'])
            $comparison = Criteria::NOT_IN;
        else
            $comparison = Criteria::IN;

        $alreadyRelated = SupplyQuery::create()->select("Id")->$filterByEntity($entity)->find()->toArray();
        $this->filterById($alreadyRelated, $comparison);
        return $this;
    }

	/**
	 * Agrega multiples filtros a la Query.
	 *
	 * @see     addFilter
	 * @param   type $filters
	 * @return  ModelCriteria
	 */
	public function addFilters($filters = array()) {
		foreach ($filters as $name => $value)
				$this->addFilter($name, $value);

		return $this;
	}

	/**
	 * Crea un pager.
	 *
	 * @param   array $filters
	 * @param   int $page
	 * @param   int $perPage
	 * @return  PropelModelPager
	 */
	public function createPager($filters, $page = 1, $perPage = 10) {
		return $this->addFilters($filters)->paginate($page, $perPage);
	}

} // SupplyQuery
