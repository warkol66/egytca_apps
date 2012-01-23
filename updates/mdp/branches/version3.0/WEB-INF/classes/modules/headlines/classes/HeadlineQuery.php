<?php



/**
 * Skeleton subclass for performing query and update operations on the 'headlines_headline' table.
 *
 * Headline
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.headlines.classes
 */
class HeadlineQuery extends BaseHeadlineQuery {

	/**
	 * Permite agregar un filtro personalizado a la Query, que puede ser
	 * traducido al campo correspondiente.
	 *
	 * @param   type $filterName
	 * @param   type $filterValue
	 * @return  ModelCriteria
	 */
	public function addFilter($filterName, $filterValue) {

		switch ($filterName) {

			case 'searchString':
				$this->filterByName("%$filterValue%", Criteria::LIKE)
					->_or()
				->filterByContent("%$filterValue%", Criteria::LIKE);
				break;

			case 'rangePublished':

				$this->filterByDatepublished($filterValue);
				break;

			case 'entityFilter':

				$entityQueryClass = ucfirst($filterValue['entityType']) . "Query";
				if (!class_exists(ucfirst($filterValue['entityType'])) || !class_exists($entityQueryClass))
					break; // nothing to filter

				$entity = $entityQueryClass::create()->findOneById($filterValue['entityId']);
				$filterByEntity = 'filterBy'.ucfirst($filterValue['entityType']);

				$queryClass = get_class($this);

				if ($filterValue['getCandidates']) {
					$alreadyRelated = $queryClass::create()->select("Id")->$filterByEntity($entity)->find()->toArray();
					$this->filterById($alreadyRelated, Criteria::NOT_IN);
				}
				else
					$this->$filterByEntity($entity);

				break;

			default:

				$peer = str_replace("Query","Peer",get_class($this));
				$filterName = ucfirst($filterName);
				if (in_array($filterName, $peer::getFieldNames(BasePeer::TYPE_PHPNAME)))
					$this->filterBy($filterName, $filterValue);
				else if (is_array($filterValue))
					$this->addFilters($filterValue);

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
			if ((isset($value) && $value != null) && $name != "perPage")
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

} // HeadlineQuery
