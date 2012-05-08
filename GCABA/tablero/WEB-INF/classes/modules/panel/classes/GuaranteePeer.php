<?php



/**
 * Skeleton subclass for performing query and update operations on the 'panel_guarantee' table.
 *
 * Base de Garantías
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.panel.classes
 */
class GuaranteePeer extends BaseGuaranteePeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Guarantees';

	const OFFER       = 1;
	const EXECUTION   = 2;
	const ADVANCE     = 3;
	const REPAIR_FUND = 4;
	const OTHER       = 9;

	const DATE   = 1;
	const TERM  = 2;
	
	const USD = 1;
	const ARS = 2;

	//nombre de los tipos de garantia
	protected static $guaranteeTypes = array(
						GuaranteePeer::OFFER       => 'Mantenimiento de oferta',
						GuaranteePeer::EXECUTION   => 'Ejecución de contrato',
						GuaranteePeer::ADVANCE     => 'Anticipo Financiero',
						GuaranteePeer::REPAIR_FUND => 'Fondo de reparo',
						GuaranteePeer::OTHER       => 'Otra',
					);

	//nombre de los tipos de vencimiento de garantia
	protected static $expirationTypes = array(
						GuaranteePeer::DATE     => 'Vencimiento por fecha',
						GuaranteePeer::TERM     => 'Vencimiento por condición'
					);

	//nombre de los tipos de vencimiento de moneda
	protected static $currencies = array(
						GuaranteePeer::USD     => 'Dólares',
						GuaranteePeer::ARS     => 'Pesos'
					);

	private $searchString;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString",
					"searchContractorId"=>"setSearchContractor"
				);

 /**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	function setSearchString($searchString){
		$this->searchString = $searchString;
	}

 /**
	 * Especifica un contratista para la busqueda.
	 * @param searchContractorId int id de busqueda.
	 */
	function setSearchContractor($searchContractorId){
		$this->searchContractorId = $searchContractorId;
	}

	/**
	 * Devuelve los tipos de garantia
	 */
	public static function getGuaranteeTypes() {
		$guaranteeTypes = GuaranteePeer::$guaranteeTypes;
		return $guaranteeTypes;
	}

	/**
	 * Devuelve los tipos de vencimiento de garantia
	 */
	public static function getExpirationTypes() {
		$expirationTypes = GuaranteePeer::$expirationTypes;
		return $expirationTypes;
	}

	/**
	 * Devuelve los tipos de moneda
	 */
	public static function getCurrencies() {
		$currencies = GuaranteePeer::$currencies;
		return $currencies;
	}

	/**
	* Obtiene un guarantee.
	*
	* @param int $id id del guarantee
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function get($id){
		$guarantee = GuaranteeQuery::create()->findPk($id);
		return $guarantee;
	}

 /**
	* Crea un guarantee nuevo.
	*
	* @param array $params con los datos del proyecto
	* @return boolean true si se creo el guarantee correctamente, false sino
	*/
	function create($params,$con = null) {
		$guarantee = new Guarantee();
		$guarantee = Common::setObjectFromParams($guarantee,$params);
		try {
			$guarantee->save($con);
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Actualiza la informacion de un guarantee.
	*
	* @param int $id id del guarantee
	* @param array $params datos del guarantee
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$params){
		$guarantee = GuaranteeQuery::create()->findPk($id);
		$guarantee = Common::setObjectFromParams($guarantee,$params);
		try {
			$guarantee->save($con);
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	* Elimina un guarantee a partir de los valores de la clave.
	*
	* @param int $id id del guarantee
	*	@return boolean true si se elimino correctamente el project, false sino
	*/
	function delete($id){
		$guarantee = GuaranteePeer::retrieveByPK($id);
		try {
			$guarantee->delete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Elimina definitivamente un guarantee a partir del id.
	*
	* @param int $id Id del guarantee
	* @return boolean true
	*/
  function hardDelete($id) {
		GuaranteePeer::disableSoftDelete();
		$guarantee = GuaranteePeer::retrieveByPk($id);
		try {
			$guarantee->forceDelete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	* Obtiene todos los guarantee desactivados.
	*
	*	@return array Informacion sobre los guarantee
	*/
	function getSoftDeleted() {
		$criteria = new Criteria();
		$criteria->add(GuaranteePeer::DELETED_AT, null, Criteria::ISNOTNULL);
		GuaranteePeer::disableSoftDelete();
		$guarantees = GuaranteePeer::doSelect($criteria);
		return $guarantees;
  }

	/**
	* Recupera del softdelete un guarantee
	*
	* @param int $id Id del guarantee
	* @return boolean true
	*/
  function recoverDeleted($id) {
		GuaranteePeer::disableSoftDelete();
		$guarantee = GuaranteePeer::retrieveByPk($id);
		try {
			$guarantee->unDelete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	 * Retorna el criteria generado a partir de los parámetros de búsqueda
	 *
	 * @return criteria $criteria Criteria con parámetros de búsqueda
	 */
	private function getSearchCriteria(){
		$criteria = new Criteria();
		$criteria->setIgnoreCase(true);
		$criteria->addAscendingOrderByColumn(GuaranteePeer::ID);

		if ($this->searchString)
			$criteria->add(GuaranteePeer::CODE,"%" . $this->searchString . "%",Criteria::LIKE);

		if ($this->searchContractorId)
			$criteria->add(GuaranteePeer::CONTRACTORID,$this->searchContractorId);

		return $criteria;

	}

 /**
	* Obtiene todos los guarantee paginados segun la condicion de busqueda ingresada.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todos los projects
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1)	{
		if ($perPage == -1)
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$criteria = $this->getSearchCriteria();
		$pager = new PropelPager($criteria,"GuaranteePeer", "doSelect",$page,$perPage);
		return $pager;
	}

  /**
  * Obtiene las garantias para incluir en los resumenes
  *
  *	@return array garantias para incluir en los resumenes
  */
  public function getIncludeGuaranteesList($options) {
  	if ($options["returned"])
  		$returned = 1;
  	else
  		$returned = 0;

  	if ($options["days"])
  		$days = $options["days"];
  	else
  		$days = 30;

		$guarantees = GuaranteeQuery::create()
				->orderByExpirationdate()
				->filterByReturned($returned)
				->filterByExpirationdate(array('max' => time() + ($days * 24 * 60 * 60)))
				->find();
    return $guarantees;
  }

} // GuaranteePeer
