<?php


/**
 * Skeleton subclass for performing query and update operations on the 'regions_regions' table.
 *
 * Regiones
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.regions.classes
 */
class RegionQuery extends BaseRegionQuery {
	
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
		if (!isset($filterValue) || ($filterValue == null && $filterValue !== false) )
			return $this;
		if (is_array($filterValue)) {
			foreach ($filterValue as $value) {
				if (!isset($value) || ($value == null && $value !== false) )
					return $this;
			}
		}
		
		switch ($filterName) {
			
			case 'SearchString':
				$this->filterByName("%$filterValue%", Criteria::LIKE)
				->_or()
					->filterByType("%$filterValue%", Criteria::LIKE)
				->_or()
					->filterByCapital("%$filterValue%", Criteria::LIKE);
				break;
			default:
				if (in_array($filterName, RegionPeer::getFieldNames(BasePeer::TYPE_PHPNAME))
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
	function addFilters($filters = array()) {
		foreach ($filters as $name => $value)
				$this->addFilter($name, $value);

		return $this;
	}
} // RegionQuery
