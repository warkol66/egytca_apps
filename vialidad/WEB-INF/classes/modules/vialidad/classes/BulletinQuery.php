<?php



/**
 * Skeleton subclass for performing query and update operations on the 'vialidad_bulletin' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.vialidad.classes
 */
class BulletinQuery extends BaseBulletinQuery {
	
	/**
	 * Filtra la Query por fechas con mismo mes y año
	 */
	public function filterByPeriodo($date) {
		$array = split('/', $date); // $array: (day, month, year)
		$range['min'] = DateTime::createFromFormat('d/m/Y', '1/'.$array[1].'/'.$array[2]);
		$lastDayOfMonth = date("t", strtotime($array[1].'/'.$array[0].'/'.$array[2]));
		$range['max'] = DateTime::createFromFormat('d/m/Y', $lastDayOfMonth.'/'.$array[1].'/'.$array[2]);
		return $this->filterByBulletindate($range);
	}
	
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
		if (is_array($filterValue)) {
			foreach ($filterValue as $value) {
				if (!isset($value) || $value == null)
					return $this;
			}
		}
		
		switch ($filterName) {
			case 'SearchString':
				$this->filterByName("%$filterValue%", Criteria::LIKE);
				break;
			case 'Bulletindate':
				$this->filterByBulletindate($filterValue, Criteria::IN);
				break;
			default:
				if (in_array($filterName, BulletinPeer::getFieldNames(BasePeer::TYPE_PHPNAME)))
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

} // BulletinQuery
