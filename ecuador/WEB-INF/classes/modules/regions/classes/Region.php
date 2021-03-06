<?php


/**
 * Skeleton subclass for representing a row from the 'regions_regions' table.
 *
 * Regiones
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.regions.classes
 */
class Region extends BaseRegion {

	/** the default item name for this class */
	const ITEM_NAME = 'Region';

	/**
	* Obtiene el nombre del padre de un region.
	*
	* @return array Informacion del region
	*/
	function getParentName()
	{
		$parent = $this->getParent();
		if (!empty($parent)) {
			return $parent->getName();
		}
		else
			return;
	}

	/**
	* Obtiene el nombre del padre de un region.
	*
	* @return array Informacion del region
	*/
	function getParentId()
	{
		$parent = $this->getParent();
		if (!empty($parent)) {
			return $parent->getId();
		}
		else
			return;
	}

	/**
	* Obtiene el nombre traducido fel tipo de region.
	*
	* @return array tipos de region
	*/
	function getRegionTypeTranslated()
	{
		$type = $this->getType();

		$regionTypes = RegionPeer::getRegionTypes();
		$regionTypeName = $regionTypes[$type];
		$regionTypeNameTranslated = Common::getTranslation($regionTypeName,'regions');
		return $regionTypeNameTranslated;

	}
	
	/**
	 * Devuelve las partidas presupuestarias
	 * @return PropelObjectCollection partidas presupuestarias
	 */
	function getBudgetItems($criteria) {
		return BudgetRelationQuery::create(null, $criteria)->filterByBudgetgeolocation($this->getOldid())->find();
	}
	
	/**
	* Devuelve el string para ser usado en el historico de operaciones
	*	@return string con el texto a guardar en el historico de operaciones
	*/
	public function getLogData(){
		return substr($this->getName(),0,50);
	}
	
	/**
	* Devuelve la cantidad de usuarios relacionados a la region
	*	@return int cantidad de usuarios asociados
	*/
	public function getUsersCount(){
		return UserQuery::create()->filterByRegionId($this->getId())->count();
	}
	
	/**
	* Obtiene todos los vecinos disponibles para la region
	*
	* @return array vecinos posibles a elegir
	*/
	public function getNeighborCandidates(){
		$id = $this->getId();
		//busco las relaciones en las que aparece la region como region y como vecino
		$regionsRegId = RegionNeighborQuery::create()->filterByRegionId($id)->select("NeighborId")->find()->toArray();
		$regions = array_merge($regionsRegId, RegionNeighborQuery::create()->filterByNeighborId($id)->select("RegionId")->find()->toArray());
		array_push($regions, $id);
		
		//return $regionsRegId;
		
		$candidates = RegionQuery::create()
										->filterById($regions, Criteria::NOT_IN)
										->filterByType($this->getType())
										->find();
		return $candidates;
	}
	
	/**
	* Obtiene los vecinos de la region
	*
	* @return array vecinos de la region
	*/
	public function getNeighbors(){
		$regionsRegId = RegionNeighborQuery::create()->filterByRegionId($this->getId())->find();
		$byRegId = array();
		foreach($regionsRegId as $region){
			$byRegId[] = $region->getRegionRelatedByNeighborid();
		}
		
		$regionsNeighId = RegionNeighborQuery::create()->filterByNeighborId($this->getId())->find();
		$byNeighId = array();
		foreach($regionsNeighId as $region){
			$byNeighId[] = $region->getRegionRelatedByRegionid();
		}
		
		$regions = array_merge($byRegId, $byNeighId);
		
		return $regions;
	}
	

} // Region
