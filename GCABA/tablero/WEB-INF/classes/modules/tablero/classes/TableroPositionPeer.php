<?php


/**
 * Skeleton subclass for performing query and update operations on the 'tablero_position' table.
 *
 * Cargos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.tablero.classes
 */
class TableroPositionPeer extends BaseTableroPositionPeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Positions';

	const GOVERNOR     = 1;
	const MINISTER     = 2;
	const MANAGER      = 3;
	const LOWEST_TYPE = TableroPositionPeer::GOVERNOR;
	const HIGHEST_TYPE = TableroPositionPeer::MANAGER;
	const TREE_ROOT_TYPE = TableroPositionPeer::GOVERNOR;

	//nombre de los tipos de region
	var $positionTypes = array(
						TableroPositionPeer::GOVERNOR    => 'Gobernador',
						TableroPositionPeer::MINISTER    => 'Ministro',
						TableroPositionPeer::MANAGER     => 'Director',
					);

	/**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	public function setSearchString($searchString) {
		$this->searchString = $searchString;
	}

	/**
	 * Especifica el tipo de position.
	 * @param int tipo de position.
	 */
	public function setSearchType($type) {
		$this->searchType = $type;
	}

	/**
	 * Especifica la position de la cual buscar descendientes.
	 * @param int id de position.
	 */
	public function setDescendatsOf($id) {
		$this->descendatsOf = $id;
	}

	/**
	 * Devuelve los nombres de los tipo de position
	 */
	public function getPositionTypes()
	{
		return array_keys($this->positionTypes);
	}

	/**
	 * Devuelve los nombres de los tipo de position traducidas
	 */
	public function getPositionTypesTranslated()
	{
		//nombre de los tipos de position
		$positionTypes = $this->positionTypes;

		foreach(array_keys($positionTypes) as $key)
			$positionTypesTranslated[$key] = Common::getTranslation($positionTypes[$key],'positions');

		return $positionTypesTranslated;
	}

	/**
	* Crea un position nuevo.
	*
	* @param string $name name del position
	* @param Connection $con [optional] Conexion a la db
	* @return boolean true si se creo el position correctamente, false sino
	*/
	function create($positionParams)
	{
		$positionObj = new Position();
		foreach ($positionParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($positionObj,$setMethod) ) {          
				if (!empty($value) || $value == "0")
					$positionObj->$setMethod($value);
				else
					$positionObj->$setMethod(null);
			}
		}

		$parentNode = TableroPositionQuery::create()->findPk($positionParams[parentId]);

		if (empty($parentNode))
			$positionObj->makeRoot();
		else
			$positionObj->insertAsLastChildOf($parentNode);

		try {
			$positionObj->save();
			return true;
		} catch (PropelException $exp) {
			return false;
		}
	}

	/**
	* Actualiza la informacion de un position.
	*
	* @param int $id id del position
	* @param string $name name del position
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$positionParam)
	{
		$positionObj = TableroPositionQuery::create()->findPk($id);
		$positionObj->setName($positionParam[name]);
		if (!empty($positionParam[scope]))
			$positionObj->setScope($positionParam[scope]);

		$parentNode = $positionObj->getParent();
		if ($parentNode->getId() != $positionParam[parentId]) {
			$parentNode = TableroPositionQuery::create()->findPk($positionParam[parentId]);
			$positionObj->moveToLastChildOf($parentNode);			
		}

		try {
			$positionObj->save();
			return true;
		} catch (PropelException $exp) {
			return false;
		}
	}

	/**
	* Elimina un position a partir de los valores de la clave.
	*
	* @param int $id id del position
	*	@return boolean true si se elimino correctamente el position, false sino
	*/
	function delete($id)
	{
		$positionObj = TableroPositionQuery::create()->findPk($id);
		$positionObj->delete();
		return true;
	}

	/**
	* Obtiene la informacion de un position.
	*
	* @param int $id id del position
	* @return array Informacion del position
	*/
	function get($id)
	{
		$positionObj = TableroPositionQuery::create()->findPk($id);
		return $positionObj;
	}

	/**
	* Obtiene todos los positions.
	*
	*	@return array Informacion sobre todos los positions
	*/
	function getAll()
	{
		$positions = TableroPositionQuery::create()->find();
		return $positions;
	}

	/**
	* Obtiene todos los posibles padres a partir de un tipo de región.
	*
	*	@return array Posibles padres a partir de un tipo de región
	*/
	function getAllPossibleParentsByType($type)
	{
		$treeRoot = TableroPositionQuery::create()->findRoot();
		if (!empty($treeRoot))
			$positions = TableroPositionQuery::create()
		  ->descendantsOf($treeRoot)
		  ->orderByBranch()
			->filterByType(array(  
		     'min' => TableroPositionPeer::LOWEST_TYPE,
		     'max' => $type-1,
		  ))
		  ->find();
		else
			return;

    return $positions;
	}

	/**
	* Obtiene todos los posibles padres a partir de un tipo de región.
	*
	*	@return array Posibles padres a partir de un tipo de región
	*/
	function getAllPossibleParents()
	{

		$treeRoot = TableroPositionQuery::create()->findRoot();
		if (!empty($treeRoot))
		$positions = TableroPositionQuery::create()
	  ->descendantsOf($treeRoot)
	  ->orderByBranch()
		->filterByType(array(  
	     'min' => TableroPositionPeer::LOWEST_TYPE,
	     'max' => TableroPositionPeer::HIGHEST_TYPE,
	  ))
	  ->find();
		else
			return;

/*
$time_end = microtime(true);
$time = $time_end - $time_start;
echo "Execution time: $time seconds\n";die;
*/
    return $positions;
	}

	/**
	* Obtiene todos los posibles padres a partir de un tipo de región.
	*
	*	@return array Posibles padres a partir de un tipo de región
	*/
	function getAllParentsByPositionType($type)
	{
		$treeRoot = TableroPositionQuery::create()->findRoot();
		if (!empty($treeRoot))
			$positions = TableroPositionQuery::create()
		  ->orderByBranch()
			->filterByType(array(  
		     'min' => TableroPositionPeer::LOWEST_TYPE,
		     'max' => $type-1,
		  ))
		  ->findTree();
    return $positions;
	}

	/**
	* Obtiene todos los positions paginados.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los positions
	*/
	function getAllPaginated($page=1,$perPage=-1)
	{
		if ($perPage == -1)
			$perPage = 	Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		require_once("propel/util/PropelPager.php");
		$cond = new Criteria();
		$pager = new PropelPager($cond,"TableroPositionPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

  /**
   * Crea una Criteria a partir de las condiciones de filtro ingresadas al peer.
   * @return Criteria instancia de criteria
   */
  private function getCriteria() {
		$criteria = new Criteria();
		$criteria->setIgnoreCase(true);
	
		if ($this->searchString)
	    $criteria->add(TableroPositionPeer::NAME,"%".$this->searchString."%",Criteria::LIKE);
	
		if ($this->searchType)
	    $criteria->add(TableroPositionPeer::TYPE, $this->searchType);

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
    require_once("propel/util/PropelPager.php");
    $cond = $this->getCriteria();     
    $pager = new PropelPager($cond,"TableroPositionPeer", "doSelect",$page,$perPage);
    return $pager;
   }

} // TableroPositionPeer
