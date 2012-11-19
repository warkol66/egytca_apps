<?php


/**
 * Skeleton subclass for performing query and update operations on the 'positions_position' table.
 *
 * Cargos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.positions.classes
 */
class PositionQuery extends BasePositionQuery {

	/**
	 * Aplica filtros automaticos por defecto
	* @return query con filtrado de dependencias ordenado por versiones
	 */
	protected function preSelect(\PropelPDO $con) {
		parent::preSelect($con);
		$this->orderByVersionid(Criteria::DESC);
		
		$loginUser = Common::getLoggedUser();
		if (!$loginUser->isAdmin()) {
			$groupIds = $loginUser->getUserGroupIds();
			$this->filterByUsergroupid($groupIds);
		}
	}

 /**
	* Aplica orden de positions por versiones
	* @return query orden de versiones
	*/
  public static function createOrderedByVersion() {
    return self::create()->orderByVersionid(Criteria::DESC);
  }

 /**
	* Aplica filtro para los position que planifican
	* @return query orden de versiones
	*/
  public function filterByDoPlanning() {
  	$planningType = key(ConfigModule::get("planning","positionsTypes"));
		$this->filterByType($planningType)
			->_or()
		->filterByPlanning(1);
  }

 /**
	* Aplica filtro segun codigo de position y respectivo grupo de usuarios
	*
	* @params $code integer code de position para filtrar pro grupo
	* @return query filtrado por gruopos de usuario 
	*/
  public function filterByGroupCode($code) {
  	if (!empty($code) && $code != 0) { 
	  	$position = PositionQuery::create()->findOneByCode($code);
			$this->filterByUsergroupid($position->getUsergroupid());
		}
  }

 /**
	* Aplica filtro por versiones
	* @return query filtro por versiones
	*/
  public function filterByLastVersion() {
    return $this->filterByVersionid(PositionVersionQuery::getLastVersionId());
  }

} // PositionQuery
