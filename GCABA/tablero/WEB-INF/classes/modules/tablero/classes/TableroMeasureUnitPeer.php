<?php


// The object class
include_once 'tablero/classes/TableroMeasureUnit.php';


/**
 * Skeleton subclass for performing query and update operations on the 'tablero_measureUnit' table.
 *
 * Unidad de Medida
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    tablero.classes
 */
class TableroMeasureUnitPeer extends BaseTableroMeasureUnitPeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Measure Units';

	private $searchString;

	/**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	function setSearchString($searchString) {
		$this->searchString = $searchString;
	}

	//mapea las condiciones del filtro en el formulario al nombre del set de la condicion en el modelo
	var $filterConditions = array(
		"searchString"=>"setSearchString"
	);

	const DECIMAL    = 1;
	const PERCENTAGE = 2;
	const INTEGER    = 3;

	//nombre de los tipos de unidades de medida
	protected static $measureUnitTypes = array(
		TableroMeasureUnitPeer::DECIMAL    => 'Decimal',
		TableroMeasureUnitPeer::PERCENTAGE => 'Percentage',
		TableroMeasureUnitPeer::INTEGER    => 'Integer'
	);

	/**
	 * Devuelve los tipos de region
	 */
	public static function getMeasureUnitTypes()
	{
		return TableroMeasureUnitPeer::$measureUnitTypes;
	}

	/**
	 * Devuelve los nombres de los tipo de region traducidas
	 */
	public function getMeasureUnitTypesTranslated()
	{
		$measureUnitTypes = TableroMeasureUnitPeer::getMeasureUnitTypes();

		foreach(array_keys($measureUnitTypes) as $key)
			$measureUnitTypesTranslated[$key] = Common::getTranslation($measureUnitTypes[$key],'regions');

		return $measureUnitTypesTranslated;
	}

	/**
	* Crea un measure unit nuevo.
	*
	* @param string $name name del measureunit
	* @return boolean true si se creo el measureunit correctamente, false sino
	*/
	function create($params) {
		$measureunitObj = new TableroMeasureUnit();

		foreach ($params as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($measureunitObj,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$measureunitObj->$setMethod($value);
				else
					$measureunitObj->$setMethod(null);
			}
		}

		$measureunitObj->save();
		return true;
	}

	/**
	* Actualiza la informacion de un measure unit.
	*
	* @param int $id id del measureunit
	* @param string $name name del measureunit
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$params) {
		$measureunitObj = TableroMeasureUnitPeer::retrieveByPK($id);

		 foreach ($params as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($measureunitObj,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$measureunitObj->$setMethod($value);
				else
					$measureunitObj->$setMethod(null);
			}
		}

		$measureunitObj->save();
		return true;
	}

	/**
	* Elimina un measure unit a partir de los valores de la clave.
	*
	* @param int $id id del measureunit
	*	@return boolean true si se elimino correctamente el measureunit, false sino
	*/
	function delete($id) {
		$measureunitObj = TableroMeasureUnitPeer::retrieveByPK($id);
		$measureunitObj->delete();
		return true;
	}

	/**
	* Obtiene la informacion de un measure unit.
	*
	* @param int $id id del measureunit
	* @return array Informacion del measureunit
	*/
	function get($id) {
		$measureunitObj = TableroMeasureUnitPeer::retrieveByPK($id);
		return $measureunitObj;
	}

	/**
	* Obtiene todos los measure units.
	*
	*	@return array Informacion sobre todos los measureunits
	*/
	function getAll() {
		$cond = new Criteria();
		$alls = TableroMeasureUnitPeer::doSelect($cond);
		return $alls;
	}

	/**
	* Obtiene un measure unit en base a su nombre.
	*
	* @param string $name Nombre de la unidad de medida
	*	@return MeasureUnit Unidad de medida con el nombre pasado como parametro
	*/
	function getByName($name) {
		$cond = new Criteria();
		$cond->add(TableroMeasureUnitPeer::NAME, $name);
		$cond->setIgnoreCase(true);
		$measureUnit = TableroMeasureUnitPeer::doSelectOne($cond);
		return $measureUnit;
	}

	/**
	* Obtiene todos los parametros de busqueda
	*
	* @return criteria
	*
	*/
	private function getSearchCriteria() {

		$criteria = new Criteria();

		if ($this->searchString)
			$criteria->add(TableroMeasureUnitPeer::NAME,"%".$this->searchString."%",Criteria::LIKE);

		return $criteria;

	}

	/**
	* Obtiene todos los projects paginados segun la condicion de busqueda ingresada.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todos los projects
	*
	*/
	function getSearchPaginated($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = 	Common::getRowsPerPage();
		if (empty($page))
			$page = 1;

		require_once("propel/util/PropelPager.php");
		$cond = $this->getSearchCriteria();

		$pager = new PropelPager($cond,"TableroMeasureUnitPeer", "doSelect",$page,$perPage);
		return $pager;
	}

} // TableroMeasureUnitPeer
