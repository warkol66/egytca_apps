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
class ModuleEntityFieldPeer extends BaseModuleEntityFieldPeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Fields';

	/**
	 * Define los tipos de dato posibles
	 */
	const TEXT_TYPE     = 1;
	const NUMERIC_TYPE  = 2;
	const BINARY_TYPE   = 3;
	const TEMPORAL_TYPE = 4;
	const BOOLEAN_TYPE  = 5;

	/**
	 * Define los tipos de dato tipo texto
	 */
	const CHAR        = 11;
	const VARCHAR     = 12;
	const LONGVARCHAR = 13;
	const CLOB        = 14;

	protected static $textTypes = array(
		ModuleEntityFieldPeer::CHAR        => 'Fixed-lenght character data',
		ModuleEntityFieldPeer::VARCHAR     => 'Variable-lenght character data',
		ModuleEntityFieldPeer::LONGVARCHAR => 'Long variable-length character data',
		ModuleEntityFieldPeer::CLOB        => 'Character LOB (locator object)'
	);

	/**
	 * Define los tipos de dato tipo numerico
	 */
	const NUMERIC  = 21;
	const DECIMAL  = 22;
	const TINYINT  = 23;
	const SMALLINT = 24;
	const INTEGER  = 25;
	const BIGINT   = 26;
	const REAL     = 27;
	const FLOAT    = 28;
	const DOUBLE   = 29;

	protected static $numericTypes = array(
		ModuleEntityFieldPeer::NUMERIC  => 'Numeric data',
		ModuleEntityFieldPeer::DECIMAL  => 'Decimal data',
		ModuleEntityFieldPeer::TINYINT  => 'Tiny integer',
		ModuleEntityFieldPeer::SMALLINT => 'Small integer',
		ModuleEntityFieldPeer::INTEGER  => 'Integer',
		ModuleEntityFieldPeer::BIGINT   => 'Large integer',
		ModuleEntityFieldPeer::REAL     => 'Real number',
		ModuleEntityFieldPeer::FLOAT    => 'Floating point number',
		ModuleEntityFieldPeer::DOUBLE   => 'Floating point number'
	);

	/**
	 * Define los tipos de dato tipo binario
	 */
	const BINARY        = 31;
	const VARBINARY     = 32;
	const LONGVARBINARY = 33;
	const BLOB          = 34;

	protected static $binaryTypes = array(
		ModuleEntityFieldPeer::BINARY    => 'Fixed-length binary data',
		ModuleEntityFieldPeer::VARBINARY    => 'Variable-length binary data',
		ModuleEntityFieldPeer::LONGVARBINARY    => 'Long variable-length binary data',
		ModuleEntityFieldPeer::BLOB    => 'Binary LOB (locator object)'
	);

	/**
	 * Define los tipos de dato tipo temporal
	 */
	const DATE      = 41;
	const TIME      = 42;
	const TIMESTAMP = 43;

	protected static $temporalTypes = array(
		ModuleEntityFieldPeer::DATE      => 'Date (e.g. YYYY-MM-DD)',
		ModuleEntityFieldPeer::TIME      => 'Time (e.g. HH:MM:SS)',
		ModuleEntityFieldPeer::TIMESTAMP => 'Date + time (e.g. YYYY-MM-DD HH:MM:SS)'
	);

	/**
	 * Define los tipos de dato tipo boolean
	 */
	const BOOLEAN = 51;

	protected static $booleanTypes = array(
		ModuleEntityFieldPeer::BOOLEAN      => 'Boolean'
	);

	/**
	 * Define los tipos de dato de texto segun MySQL
	 */
	protected static $textTypesMySql = array(
		ModuleEntityFieldPeer::CHAR        => 'CHAR',
		ModuleEntityFieldPeer::VARCHAR     => 'VARCHAR',
		ModuleEntityFieldPeer::LONGVARCHAR => 'TEXT',
		ModuleEntityFieldPeer::CLOB        => 'LONGTEXT'
	);

	/**
	 * Define los tipos de dato de texto segun Propel
	 */
	protected static $textTypesPropel = array(
		ModuleEntityFieldPeer::CHAR        => 'CHAR',
		ModuleEntityFieldPeer::VARCHAR     => 'VARCHAR',
		ModuleEntityFieldPeer::LONGVARCHAR => 'LONGVARCHAR',
		ModuleEntityFieldPeer::CLOB        => 'CLOB'
	);

	/**
	 * Define los tipos de dato numerico segun MySQL
	 */
	protected static $numericTypesMySql = array(
		ModuleEntityFieldPeer::NUMERIC  => 'DECIMAL',
		ModuleEntityFieldPeer::DECIMAL  => 'DECIMAL',
		ModuleEntityFieldPeer::TINYINT  => 'TINYINT',
		ModuleEntityFieldPeer::SMALLINT => 'SMALLINT',
		ModuleEntityFieldPeer::INTEGER  => 'INTEGER',
		ModuleEntityFieldPeer::BIGINT   => 'BIGINT',
		ModuleEntityFieldPeer::REAL     => 'REAL',
		ModuleEntityFieldPeer::FLOAT    => 'FLOAT',
		ModuleEntityFieldPeer::DOUBLE   => 'DOUBLE'
	);

	/**
	 * Define los tipos de dato numerico segun Propel
	 */
	protected static $numericTypesPropel = array(
		ModuleEntityFieldPeer::NUMERIC  => 'DECIMAL',
		ModuleEntityFieldPeer::DECIMAL  => 'DECIMAL',
		ModuleEntityFieldPeer::TINYINT  => 'TINYINT',
		ModuleEntityFieldPeer::SMALLINT => 'SMALLINT',
		ModuleEntityFieldPeer::INTEGER  => 'INTEGER',
		ModuleEntityFieldPeer::BIGINT   => 'BIGINT',
		ModuleEntityFieldPeer::REAL     => 'REAL',
		ModuleEntityFieldPeer::FLOAT    => 'FLOAT',
		ModuleEntityFieldPeer::DOUBLE   => 'DOUBLE'
	);

	/**
	 * Define los tipos de dato binario segun MySQL
	 */
	protected static $binaryTypesMySql = array(
		ModuleEntityFieldPeer::BINARY        => 'BLOB',
		ModuleEntityFieldPeer::VARBINARY     => 'MEDIUMBLOB',
		ModuleEntityFieldPeer::LONGVARBINARY => 'LONGBLOB',
		ModuleEntityFieldPeer::BLOB          => 'LONGBLOB'
	);

	/**
	 * Define los tipos de dato binario segun Propel
	 */
	protected static $binaryTypesPropel = array(
		ModuleEntityFieldPeer::BINARY        => 'BLOB',
		ModuleEntityFieldPeer::VARBINARY     => 'BLOB',
		ModuleEntityFieldPeer::LONGVARBINARY => 'BLOB',
		ModuleEntityFieldPeer::BLOB          => 'BLOB'
	);

	/**
	 * Define los tipos de dato temporal segun MySQL
	 */
	protected static $temporalTypesMySql = array(
		ModuleEntityFieldPeer::DATE      => 'DATE',
		ModuleEntityFieldPeer::TIME      => 'TIME',
		ModuleEntityFieldPeer::TIMESTAMP => 'TIMESTAMP'
	);

	/**
	 * Define los tipos de dato temporal segun Propel
	 */
	protected static $temporalTypesPropel = array(
		ModuleEntityFieldPeer::DATE      => 'DATE',
		ModuleEntityFieldPeer::TIME      => 'TIME',
		ModuleEntityFieldPeer::TIMESTAMP => 'TIMESTAMP'
	);

	/**
	 * Define los tipos de dato boolean segun MySQL
	 */
	protected static $booleanTypesMySql = array(
		ModuleEntityFieldPeer::BOOLEAN   => 'BOOL'
	);

	/**
	 * Define los tipos de dato boolean segun Propel
	 */
	protected static $booleanTypesPropel = array(
		ModuleEntityFieldPeer::BOOLEAN   => 'BOOLEAN'
	);

	/**
	 * Devuelve los tipos de campos
	 */
	public static function getFieldTypes(){
		$fieldTypes = array(
			ModuleEntityFieldPeer::TEXT_TYPE       => array('name' => 'Text type', 'types' => ModuleEntityFieldPeer::getTextTypes()),
			ModuleEntityFieldPeer::NUMERIC_TYPE    => array('name' => 'Numeric type', 'types' => ModuleEntityFieldPeer::getNumericTypes()),
			ModuleEntityFieldPeer::BINARY_TYPE     => array('name' => 'Binary type', 'types' => ModuleEntityFieldPeer::getBinaryTypes()),
			ModuleEntityFieldPeer::TEMPORAL_TYPE   => array('name' => 'Temporal (time/date) type', 'types' => ModuleEntityFieldPeer::getTemporalTypes()),
			ModuleEntityFieldPeer::BOOLEAN_TYPE   => array('name' => 'Boolean type', 'types' => ModuleEntityFieldPeer::getBooleanTypes())
		);		
		return $fieldTypes;
	}
	/**
	 * Devuelve los tipos de campos de texto
	 */
	public static function getTextTypes(){
		$textTypes = ModuleEntityFieldPeer::$textTypes;
		return $textTypes;
	}
	/**
	 * Devuelve los tipos de campos numericos
	 */
	public static function getNumericTypes(){
		$numericTypes = ModuleEntityFieldPeer::$numericTypes;
		return $numericTypes;
	}
	/**
	 * Devuelve los tipos de campos binarios
	 */
	public static function getBinaryTypes(){
		$binaryTypes = ModuleEntityFieldPeer::$binaryTypes;
		return $binaryTypes;
	}
	/**
	 * Devuelve los tipos de campos temporales
	 */
	public static function getTemporalTypes(){
		$temporalTypes = ModuleEntityFieldPeer::$temporalTypes;
		return $temporalTypes;
	}
	/**
	 * Devuelve los tipos de campos booleans
	 */
	public static function getBooleanTypes(){
		$booleanTypes = ModuleEntityFieldPeer::$booleanTypes;
		return $booleanTypes;
	}
	/**
	 * Devuelve los tipos en MySQL
	 */
	public static function getTypesMySql(){
		$textTypesMySql = ModuleEntityFieldPeer::getTextTypesMySql();
		$numericTypesMySql = ModuleEntityFieldPeer::getNumericTypesMySql();
		$binaryTypesMySql = ModuleEntityFieldPeer::getBinaryTypesMySql();
		$temporalTypesMySql = ModuleEntityFieldPeer::getTemporalTypesMySql();
		$booleanTypesMySql = ModuleEntityFieldPeer::getBooeanTypesMySql();
		return $textTypesMySql + $numericTypesMySql + $binaryTypesMySql + $temporalTypesMySql + $booleanTypesMySql;
	}	
	/**
	 * Devuelve los tipos en Propel
	 */
	public static function getTypesPropel(){
		$textTypesPropel = ModuleEntityFieldPeer::getTextTypesPropel();
		$numericTypesPropel = ModuleEntityFieldPeer::getNumericTypesPropel();
		$binaryTypesPropel = ModuleEntityFieldPeer::getBinaryTypesPropel();
		$temporalTypesPropel = ModuleEntityFieldPeer::getTemporalTypesPropel();
		$booleanTypesPropel = ModuleEntityFieldPeer::getBooeanTypesPropel();
		return $textTypesPropel + $numericTypesPropel + $binaryTypesPropel + $temporalTypesPropel + $booleanTypesPropel;
	}	
	/**
	 * Devuelve los tipos de campos de texto en MySQL
	 */
	public static function getTextTypesMySql(){
		$textTypesMySql = ModuleEntityFieldPeer::$textTypesMySql;
		return $textTypesMySql;
	}
	/**
	 * Devuelve los tipos de campos de texto en Propel
	 */
	public static function getTextTypesPropel(){
		$textTypesPropel = ModuleEntityFieldPeer::$textTypesPropel;
		return $textTypesPropel;
	}
	/**
	 * Devuelve los tipos de campos numericos en MySql
	 */
	public static function getNumericTypesMySql(){
		$numericTypesMySql = ModuleEntityFieldPeer::$numericTypesMySql;
		return $numericTypesMySql;
	}
	/**
	 * Devuelve los tipos de campos numericos en Propel
	 */
	public static function getNumericTypesPropel(){
		$numericTypesPropel = ModuleEntityFieldPeer::$numericTypesPropel;
		return $numericTypesPropel;
	}
	/**
	 * Devuelve los tipos de campos binarios en MySql
	 */
	public static function getBinaryTypesMySql(){
		$binaryTypesMySql = ModuleEntityFieldPeer::$binaryTypesMySql;
		return $binaryTypesMySql;
	}
	/**
	 * Devuelve los tipos de campos binarios en Propel
	 */
	public static function getBinaryTypesPropel(){
		$binaryTypesPropel = ModuleEntityFieldPeer::$binaryTypesPropel;
		return $binaryTypesPropel;
	}
	/**
	 * Devuelve los tipos de campos temporales en MySql
	 */
	public static function getTemporalTypesMySql(){
		$temporalTypesMySql = ModuleEntityFieldPeer::$temporalTypesMySql;
		return $temporalTypesMySql;
	}
	/**
	 * Devuelve los tipos de campos temporales en Propel
	 */
	public static function getTemporalTypesPropel(){
		$temporalTypesPropel = ModuleEntityFieldPeer::$temporalTypesPropel;
		return $temporalTypesPropel;
	}

	/**
	 * Devuelve los tipos de campos booleans en MySql
	 */
	public static function getBooeanTypesMySql(){
		$booleanTypesMySql = ModuleEntityFieldPeer::$booleanTypesMySql;
		return $booleanTypesMySql;
	}

	/**
	 * Devuelve los tipos de campos booleans en Propel
	 */
	public static function getBooeanTypesPropel(){
		$booleanTypesPropel = ModuleEntityFieldPeer::$booleanTypesPropel;
		return $booleanTypesPropel;
	}

	//opciones de filtrado
	private $searchString;
	private $searchModule;
	private $searchEntity;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString",
					"searchModule"=>"setSearchModule",
					"searchEntity"=>"setSearchEntity"
				);

 /**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	function setSearchString($searchString){
		$this->searchString = $searchString;
	}

 /**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	function setSearchModule($setSearchModule){
		$this->setSearchModule = $setSearchModule;
	}
 /**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	function setSearchEntity($searchEntity){
		$this->searchEntity = $searchEntity;
	}

	/**
	* Devuelve el campo
	* @param integer $id id de la region
	* @return region
	*/
	public function get($id){
		$field = ModuleEntityFieldPeer::retrieveByPK($id);
		return $field;
	}

	/**
	* Crea un region nuevo.
	*
	* @param string $name name del region
	* @param Connection $con [optional] Conexion a la db
	* @return boolean true si se creo el region correctamente, false sino
	*/
	function create($fieldParams){
		$fieldObj = new ModuleEntityField();
		foreach ($fieldParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($fieldObj,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$fieldObj->$setMethod($value);
				else
					$fieldObj->$setMethod(null);
			}
		}
		try {
			$fieldObj->save();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Actualiza la informacion de un region.
	*
	* @param int $id id del region
	* @param string $name name del region
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$fieldParams){
		$fieldObj = ModuleEntityFieldQuery::create()->findPk($id);
		foreach ($fieldParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($fieldObj,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$fieldObj->$setMethod($value);
				else
					$fieldObj->$setMethod(null);
			}
		}
		try {
			$fieldObj->save();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Elimina un region a partir de los valores de la clave.
	*
	* @param int $id id del region
	*	@return boolean true si se elimino correctamente el region, false sino
	*/
	function delete($id){
		$fieldObj = ModuleEntityFieldQuery::create()->findPk($id);
		try {
			$fieldObj->delete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Obtiene todos los regions.
	*
	*	@return array Informacion sobre todos los regions
	*/
	function getAll(){
		$fields = ModuleEntityFieldQuery::create()->find();
		return $fields;
	}

	/**
	* Obtiene todos los regions.
	*
	*	@return array Informacion sobre todos los regions
	*/
	function getAllByType($type){
		$fields = ModuleEntityFieldQuery::create()
			->filterByType($type)
			->find();
		return $fields;
	}

	/**
	* Obtiene todos los fields de una entidad.
	*
	*	@return array Informacion sobre todos los fields de una entidad
	*/
	function getAllByEntity($entityName){
		$fields = ModuleEntityFieldQuery::create()
			->filterByEntityName($entityName)
			->find();
		return $fields;
	}

	/**
	* Obtiene todos los regions paginados.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los regions
	*/
	function getAllPaginated($page=1, $perPage=-1){
		if ($perPage == -1)
			$perPage = 	Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = $this->getCriteria();
		$pager = new PropelPager($cond, "ModuleEntityFieldPeer", "doSelect", $page, $perPage);
		return $pager;
	 }

	/**
	 * Crea una Criteria a partir de las condiciones de filtro ingresadas al peer.
	 * @return Criteria instancia de criteria
	 */
	private function getCriteria(){
		$criteria = new Criteria();
		$criteria->setIgnoreCase(true);

		if ($this->searchString) {
			$criterionString = $criteria->getNewCriterion(ModuleEntityFieldPeer::NAME,"%" . $this->searchString . "%",Criteria::LIKE);
			$criterionString->addOr($criteria->getNewCriterion(ModuleEntityFieldPeer::DESCRIPTION,"%" . $this->searchString . "%",Criteria::LIKE));
			$criterionString->addOr($criteria->getNewCriterion(ModuleEntityFieldPeer::LABEL,"%" . $this->searchString . "%",Criteria::LIKE));
			$criteria->addAnd($criterionString);		
		}
		if (!empty($this->searchModule)){
			$criteria->addJoin(ModuleEntityFieldPeer::ENTITYID, ModuleEntityPeer::ID, Criteria::INNER_JOIN);
			$criteria->add(ModuleEntityPeer::MODULENAME, $this->searchModule);
		}
		if (!empty($this->searchEntity))
			$criteria->add(ModuleEntityFieldPeer::ENTITYID, $this->searchEntity);


		return $criteria;

	}

} // ModuleEntityFieldPeer
