<?php


/**
 * Skeleton subclass for performing query and update operations on the 'regions_timezones' table.
 *
 * Regiones y Zonas
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.regions.classes
 */
class RegionTimezonePeer extends BaseRegionTimezonePeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Region Timezones';

	/**
	* Obtiene todos los regions.
	*
	*	@return array Informacion sobre todos los regions
	*/
	function getAll()
	{
		$regions = RegionTimezoneQuery::create()->find();
		return $regions;
	}


	/**
	 * Crea una Criteria a partir de las condiciones de filtro ingresadas al peer.
	 * @return Criteria instancia de criteria
	 */
	private function getCriteria() {
		$criteria = new Criteria();
		$criteria->setIgnoreCase(true);

		if ($this->searchString)
			$criteria->add(RegionTimezonePeer::NAME,"%".$this->searchString."%",Criteria::LIKE);

		if ($this->searchType)
			$criteria->add(RegionTimezonePeer::TYPE, $this->searchType);

		if ($this->descendantsOf)
			$criteria->add(TableroObjectivePeer::AFFILIATEID,$this->affiliateId);

		return $criteria;

	}

	/**
	* Obtiene todas las activities paginados con las opciones de filtro asignadas al peer.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los activities
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = $this->getCriteria();
		$pager = new PropelPager($cond,"RegionTimezonePeer", "doSelect",$page,$perPage);
		return $pager;
	 }

	function getIdentifiers($continent) {

		$timezone_identifiers = DateTimeZone::listIdentifiers();
		$timeZones = array();
		foreach($timezone_identifiers as $value) {
			if (empty($continent)) {
				if (preg_match('/^(America|Antartica|Arctic|Asia|Atlantic|Europe|Indian|Pacific)\//', $value))
					array_push($timeZones, $value);
			}
			else if (preg_match('/^$continent\//', $value))
				array_push($timeZones, $value);

		}
		return $timeZones;
	}

	/**
	* Crea un region nuevo.
	*
	* @param string $name name del region
	* @param Connection $con [optional] Conexion a la db
	* @return boolean true si se creo el region correctamente, false sino
	*/
	function create($regionParam)
	{
		$regionObj = new RegionTimezone();
		$regionObj->setName($regionParam[name]);
		if (!empty($regionParam[scope]))
			$regionObj->setScope($regionParam[scope]);

		$parentNode = RegionTimezoneQuery::create()->findPk($regionParam[parentId]);

		if (empty($parentNode))
			$regionObj->makeRoot();
		else
			$regionObj->insertAsLastChildOf($parentNode);

		try {
			$regionObj->save();
			return true;
		} catch (PropelException $exp) {
			return false;
		}
	}


	/**
	* Obtiene la informacion de un region.
	*
	* @param int $id id del region
	* @return array Informacion del region
	*/
	function get($id)
	{
		$regionObj = RegionTimezoneQuery::create()->findPk($id);
		return $regionObj;
	}


	const AMERICA   = "America";
	const ANTARTICA = "Antartica";
	const ARCTIC    = "Arctic";
	const ASIA      = "Asia";
	const ATLANTIC  = "Atlantic";
	const EUROPE    = "Europe";
	const INDIAN    = "Indian";
	const PACIFIC   = "Pacific";

	var $continents = array(
		RegionTimezonePeer::AMERICA,
		RegionTimezonePeer::ANTARTICA,
		RegionTimezonePeer::ARCTIC,
		RegionTimezonePeer::ASIA,
		RegionTimezonePeer::ATLANTIC,
		RegionTimezonePeer::EUROPE,
		RegionTimezonePeer::INDIAN,
		RegionTimezonePeer::PACIFIC
	);

	const CONTINENT    = 1;
	const BLOQUE       = 2;
	const COUNTRY      = 3;
	const SUBREGION    = 4;
	const STATE        = 5;
	const COUNTY       = 6;
	const CITY         = 7;
	const COMMUNE      = 8;
	const NEIGHBORHOOD = 9;
	const POSTAL_CODE  = 10;

	//nombre de los tipos de region
	var $regionTypes = array(
						RegionPeer::CONTINENT    => 'Continent',
						RegionPeer::BLOQUE       => 'Bloque',
						RegionPeer::COUNTRY      => 'Country',
						RegionPeer::SUBREGION    => 'Subregion',
						RegionPeer::STATE        => 'State',
						RegionPeer::COUNTY       => 'County',
						RegionPeer::CITY         => 'City',
						RegionPeer::COMMUNE      => 'Commune',
						RegionPeer::NEIGHBORHOOD => 'Neighborhood',
						RegionPeer::POSTAL_CODE  => 'Postal code',
					);

	//opciones de filtrado
	private  $type;
	private  $descendantsOf;
	private  $searchString;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString",
					"descendantsOf"=>"setDescendantsOf",
					"type"=>"setSearchType"
				);


	/**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	public function setSearchString($searchString) {
		$this->searchString = $searchString;
	}

	/**
	 * Especifica el tipo de region.
	 * @param int tipo de region.
	 */
	public function setSearchType($type) {
		$this->searchType = $type;
	}

	/**
	 * Devuelve los nombres de los tipo de region
	 */
	public function getRegionTypes()
	{
		return array_keys($this->regionTypes);
	}

	/**
	 * Devuelve los nombres de los tipo de region traducidas
	 */
	public function getRegionTypesTranslated()
	{
		//nombre de los tipos de region
		$regionTypes = $this->regionTypes;

		foreach(array_keys($regionTypes) as $key)
			$regionTypesTranslated[$key] = Common::getTranslation($regionTypes[$key],'regions');

		return $regionTypesTranslated;
	}


} // RegionTimezonePeer
