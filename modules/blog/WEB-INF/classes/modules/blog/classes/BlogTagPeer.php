<?php



/**
 * Skeleton subclass for performing query and update operations on the 'blog_tag' table.
 *
 * Etioquetas de blog
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.blog.classes
 */
class BlogTagPeer extends BaseBlogTagPeer {

	//opciones de filtrado
	private  $searchString;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString"
				);

	/**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	public function setSearchString($searchString){
		$this->searchString = $searchString;
	}

	/**
	* Obtiene la informacion de un indicator.
	*
	* @param int $id id del indicator
	* @return array Informacion del indicator
	*/
	function get($id){
		$blogTag = BlogTagQuery::create()->findPk($id);
		return $blogTag;
	}

	/**
	* Obtiene la informacion de un indicator.
	*
	* @param int $id id del indicator
	* @return array Informacion del indicator
	*/
	function getByName($name){
		$blogTag = BlogTagQuery::create()->findOneByName($name);
		return $blogTag;
	}


	/**
	* Crea un indicator nuevo.
	*
	* @param string $name name del indicator
	* @param Connection $con [optional] Conexion a la db
	* @return boolean true si se creo el indicator correctamente, false sino
	*/
	function create($params){
		$object = new BlogTag();

		$object = Common::setObjectFromParams($object,$params);

		try {
			$object->save();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Actualiza la informacion de un indicator.
	*
	* @param int $id id del indicator
	* @param string $name name del indicator
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$params){
		$object = BlogTagQuery::create()->findPk($id);

		$object = Common::setObjectFromParams($object,$params);

		try {
			$object->save();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Elimina un indicator a partir de los valores de la clave.
	*
	* @param int $id id del indicator
	*	@return boolean true si se elimino correctamente el indicator, false sino
	*/
	function delete($id){
		$categoryObj = BlogTagQuery::create()->findPk($id);
		$categoryObj->delete();
		return true;
	}

	/**
	* Obtiene todos los indicators.
	*
	*	@return array Informacion sobre todos los indicators category
	*/
	function getAll(){
		$tags = BlogTagQuery::create()->find();
		return $tags;
	}

	/**
	* Obtiene todos los regions paginados.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los regions
	*/
	function getAllPaginated($page=1,$perPage=-1){
		if ($perPage == -1)
			$perPage = 	Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$criteria = new Criteria();
		$pager = new PropelPager($criteria,"BlogTagPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

  /**
   * Crea una Criteria a partir de las condiciones de filtro ingresadas al peer.
   * @return Criteria instancia de criteria
   */
  private function getCriteria(){
		$criteria = BlogTagQuery::create();
		$criteria->setIgnoreCase(true);
	
		if ($this->searchString)
	    $criteria->add(BlogTagPeer::NAME,"%".$this->searchString."%",Criteria::LIKE);

		return $criteria;
	
  }

  /**
  * Obtiene todas las activities paginados con las opciones de filtro asignadas al peer.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los activities
  */
  function getAllPaginatedFiltered($page=1,$perPage=-1){  
    if ($perPage == -1)
      $perPage = Common::getRowsPerPage();
    if (empty($page))
      $page = 1;
    $criteria = $this->getCriteria();     
    $pager = new PropelPager($criteria,"BlogTagPeer", "doSelect",$page,$perPage);
    return $pager;
   }

  /**
  * Obtiene todas las etiquetas posibles
  *
  * @param $entry Entrada
  *	@return array Informacion sobre todos los activities
  */
  function getTagCandidates($entry){  
    if ($entry->getId() == 0)
      $tags = BlogTagQuery::create()->orderByName()->find();
    else {
    	$tagsAssignedObj = BlogTagRelationQuery::create()
    			->filterByEntryid($entry->getId())
    			->find();
    	$tagsAssigned = array();
    	foreach ($tagsAssignedObj as $tag)
				array_push($tagsAssigned, $tag->getTagId());	
			$criteria = new Criteria();
			$criteria->add(BlogTagPeer::ID,$tagsAssigned,Criteria::NOT_IN);
			$criteria->addAscendingOrderByColumn(BlogTagPeer::NAME);
			$tags = BlogTagPeer::doSelect($criteria);
		}
    return $tags;
   }

  /**
  * Obtiene todas las activities paginados con las opciones de filtro asignadas al peer.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los activities
  */
  public function getIncludeTagCloud(){
		$tags = BlogTagRelationQuery::create()
		  ->join('BlogTag')
		  ->orderBy('BlogTag.Name')
		  ->withColumn('count(BlogTag.Id)', 'nbEntries')
		  ->withColumn('BlogTag.Id', 'blogTagId')
		  ->withColumn('BlogTag.Name', 'blogTagName')
		  ->groupBy('BlogTagRelation.Tagid')
		  ->select(array('BlogTag.Id', 'BlogTag.Name', 'nbEntries'))
		  ->find();
		$totalTags = BlogTagRelationQuery::create()->count();

		$tagsArr = $tagsArray = $tags->toArray();
		asort($tagsArr);
		$maxArray = array_pop($tagsArr);
		$max = $maxArray['nbEntries'];
		$minArray = array_shift($tagsArr);
		$min = $minArray['nbEntries'];

		foreach ($tagsArray as $key => $tag)
			$tagsArray[$key]['weight'] = 1 + (floor( ($tag['nbEntries'] - $min) / ($max - $min) * 7));

    return $tagsArray;
  }



} // BlogTagPeer

