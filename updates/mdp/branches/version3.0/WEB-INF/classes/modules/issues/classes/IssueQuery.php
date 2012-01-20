<?php



/**
 * Skeleton subclass for performing query and update operations on the 'issues_issue' table.
 *
 * Asuntos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.issues.classes
 */
class IssueQuery extends BaseIssueQuery {
	
	/**
	 * Permite agregar un filtro personalizado a la Query, que puede ser
	 * traducido al campo correspondiente.
	 *
	 * @param   type $filterName
	 * @param   type $filterValue
	 * @return  ModelCriteria
	 */
	public function addFilter($filterName, $filterValue) {

		$filterName = ucfirst($filterName);
		
		// empty() no sirve porque algunos filtros admiten 0 como valor
		// quiero permitir false como valor
		if (!isset($filterValue) || $filterValue === null)
			return $this;
		if (is_array($filterValue)) {
			foreach ($filterValue as $value) {
				if (!isset($value) || $value === null)
					return $this;
			}
		}

		switch ($filterName) {
			
			case 'SearchString':
				$this->filterByName("%$filterValue%", Criteria::LIKE)
				->_or()
					->filterByDescription("%$filterValue%", Criteria::LIKE);
				break;
			
			case 'IdsFilter':
				$comparison = $filterValue['getCandidates'] ? $comparison = Criteria::NOT_IN : $comparison = Criteria::IN;
				$this->filterById($filterValue['ids'], $comparison);
				break;
			
			case 'EntityFilter':

				$entityQueryClass = ucfirst($filterValue['entityType']).'Query';
				if (!class_exists(ucfirst($filterValue['entityType'])) || !class_exists($entityQueryClass))
					break; // nothing to filter

				$entity = $entityQueryClass::create()->findOneById($filterValue['entityId']);
				
				if (get_class($this) == $entityQueryClass) {
					$this->addFilter('IdsFilter', array(
						'ids' => array($entity->getId()),
						'getCandidates' => $filterValue['getCandidates']
					));
					break;
				}

				$filterByEntity = 'filterBy'.ucfirst($filterValue['entityType']);
				
				$comparison = $filterValue['getCandidates'] ? $comparison = Criteria::NOT_IN : $comparison = Criteria::IN;
				
				$auxiliarQueryClass = get_class($this);
				$alreadyRelated = $auxiliarQueryClass::create()->select("Id")->$filterByEntity($entity)->find()->toArray();
				$this->filterById($alreadyRelated, $comparison);
				break;
				
			default:
				if (in_array($filterName, IssuePeer::getFieldNames(BasePeer::TYPE_PHPNAME))
					|| is_array($filterValue) )
						$this->filterBy($filterName, $filterValue);
				else {
						//Log - campo inexistente.
				}

				break;
		}

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

} // IssueQuery
