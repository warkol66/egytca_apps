<?php

/**
 * Skeleton subclass for representing a row from the 'blog_entry' table.
 *
 * Entradas del Blog
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.blog.classes
 */
class BlogEntry extends BaseBlogEntry {
	
	private $orderByDate = false;
	private $orderByUpdateDate = false;
	private $publishedMode = false;
	private $fromDate;
	private $toDate;
	private $category;
	private $period;
	private $tag;
	private $searchString;
	private $moduleConfig;
	private $entriesInHome;
	private $reverseOrder = false;
	
	/*Posibles estados de la entrada*/
	const NOT_PUBLISHED = 1;
	const PUBLISHED = 2;
	const ARCHIVED = 3;

	/**
	 * Devuelve los estados posibles de la noticias y sus codigos 
	 * para la generacion de selects
	 */
	public function getStatuses() {
		$status[BlogEntry::NOT_PUBLISHED] = 'No Publicada';
		$status[BlogEntry::PUBLISHED] = 'Publicada';
		$status[BlogEntry::ARCHIVED] = 'Archivada';
		return $status;
	}
	
		/**
	 * Especifica una cadena de busqueda. Cada palabra de la cadena sera extraida y buscada en
	 * titulos, descripcion, copete, etc.
	 * @param string cadena de busqueda.
	 */
	public function setSearchString($string) {
		$this->searchString = $string;
	}

	/**
	 * Especifica una fecha hasta para una busqueda personalizada.
	 *
	 * @param $period string YYYYMM
	 */
	public function setPeriod($period) {
		$this->period = $period;		
	}
	
	/**
	 * Aplica ordenamiento por fecha a las consultas
	 */	
	public function setOrderByDate() {
		$this->orderByDate = true;
	}

	/**
	 * Aplica ordenamiento por fecha de actualizacion a las consultas
	 */	
	public function setOrderByUpdateDate() {
		$this->orderByUpdateDate = true;
	}

	/**
	 * Aplica ordenamiento por fecha de creacion a las consultas
	 */	
	public function setOrderByCreationDate() {
		$this->orderByCreationDate = true;
	}
	
	/**
	 * Aplica ordenamiento por fecha de creacion a las consultas
	 */	
	public function setReverseOrder() {
		$this->reverseOrder = true;
	}
	
	public function setPublishedMode() {
		$this->publishedMode = true;
	}
	
	/**
	* Crea un Preview de una articulo.
	* Devuelve una instancia de articulo el cual no ha salvado en la base de datos.
	*
	* @param array $params Array asociativo con los atributos del objeto
	* @return boolean true si se creo correctamente, false sino
	*/  
	function createPreview($params) {

			$blogEntryObj = new BlogEntry();
			$blogEntryObj = Common::setObjectFromParams($blogEntryObj,$params);

		return $blogEntryObj;
	}  
	
	/**
	 * Incrementa la cantidad de vistas que tiene el articulo
	 * y lo persiste
	 */
	public function increaseViews() {
		
		try {
			$counter = $this->getViews();
			$counter++;
			$this->setViews($counter);
			parent::save();

		} catch (PropelException $e) {
			return false;
		}

		return true;
		
	}
	
	/**
	 * Obtiene la cantidad de articulos aprobados que pueden ser mostrados por interfaz
	 * del articulo
	 * @return integer
	 */ 
	public function getApprovedCommentsCount() {
		
		$criteria = $this->getApprovedCommentsCriteria();
		return BlogCommentPeer::doCount($criteria);
		
	}

	/**
	 * Genera la criteria necesaria para obtener todos los comentarios aprobados para el
	 * Articulos
	 * @return Criteria
	 */
	private function getApprovedCommentsCriteria() {
		$criteria = new Criteria();
		$criteria->add(BlogCommentPeer::ENTRYID,$this->getId());
		$criteria->add(BlogCommentPeer::STATUS,BlogComment::APPROVED);
		return $criteria;
	}
	
 	/**
     * Code to be run before inserting to database
     * @param PropelPDO $con 
     * @return boolean 
     */
    public function preInsert(PropelPDO $con = null) {
    	$uniqueUrl = BlogEntry::getUrlFromTitle($this->getTitle());
    	$this->setUrl($uniqueUrl);
        return true;
    }
    
    /**
	 * Devuelve una Url única que corresponde a la entrada del blog a partir de su titulo.
	 * 
	 * La url es generada encadenando las palabras con '_' y agregando un sufijo numérico 
	 * si es necesario para mantener la unicidad. Los caracteres que forman parte del ASCII 
     * extendido son transliterados a ASCII. Cualquier caractér inválido es descartado.
	 * 
	 *
	 * @param $title título.
	 * @return url del blog.
	 */
	public static function getUrlFromTitle($title) {
		$url = preg_replace('/\s+/', '_', $title);               // \s: whitespace characters
		$url = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $url);  // esto es para pasar cosas como 'é' a 'e'
		$url = preg_replace('/\W/', '', $url);                   // \W: non-word characters
		$url = preg_replace('/(^_)|(_$)/', '', $url);                   // es posible que hayan quedado '_' al principio o al final.
		$url = preg_replace('/_+/', '_', $url);					 // cualquier cantidad de '_' consecutiva debe reducirse.
		$url = strtolower($url);
		$sufix = '';
		$counter = 1;
		BlogEntryQuery::disableSoftDelete();      //necesario para que devuelva en la consulta las que estan eliminadas.
		do {
			$uniqueUrl = $url . $sufix; 
			$unicity = BlogEntryQuery::create()->filterByUrl($uniqueUrl)->count();
			$sufix = '_' . $counter;
			$counter++;
		} while($unicity !== 0);
		BlogEntryQuery::enableSoftDelete();
		
		return $uniqueUrl;
	}
	
	/**
	* Obtiene la cantidad de filas por pagina por defecto en los listado paginados.
	*
	* @return int Cantidad de filas por pagina
	*/
	function getRowsPerPage() {
		$moduleConfig = Common::getModuleConfiguration('Blog');
		if ($moduleConfig["entriesPerPage"] > 0)
			return $moduleConfig["entriesPerPage"];
		else {
			$systemConfig = Common::getModuleConfiguration('System');
			return $systemConfig['rowsPerPage'];
		}
	}
	
	/**
	 * Obtiene los ultimos N articulos publicados
	 * @param integer cantidad de ultimos articulos publicados a obtener
	 * @return Array array de instancias de NewsArticle
	 */
	public function getLastEntries($quantity) {
		
		$criteria = new Criteria();
		$criteria->addDescendingOrderByColumn(BlogEntryPeer::CREATIONDATE);
		$criteria->add(BlogEntryPeer::STATUS,BlogEntryPeer::PUBLISHED);
		$criteria->setLimit($quantity);
		
		return BlogEntryPeer::doSelect($criteria);
		
	}
	
	/**
	 * Crea una Criteria a partir de las condiciones de filtro ingresadas.
	 * @return Criteria instancia de criteria
	 */
	private function getCriteria() {
	$criteria = new Criteria();	
	$criteria->setIgnoreCase(true);

	if ($this->reverseOrder)
		$criteria->addDescendingOrderByColumn(BlogEntryPeer::CREATIONDATE);
	else
		$criteria->addAscendingOrderByColumn(BlogEntryPeer::CREATIONDATE);

	if (!empty($this->tag)) {
		$criteriaOnTag = $criteria->getNewCriterion(BlogTagRelationPeer::TAGID,$this->tag);
		$criteria->addJoin(BlogEntryPeer::ID, BlogTagRelationPeer::ENTRYID, Criteria::RIGHT_JOIN);
		$criteria->addAnd($criteriaOnTag);
	}

	if (!empty($this->category))
		$criteria->add(BlogEntryPeer::CATEGORYID, $this->category);

	if (!empty($this->publishedMode))
		$criteria->add(BlogEntryPeer::STATUS, BlogEntry::PUBLISHED);

	if (!empty($this->period)) {
		$periodBegin = date("Y-m-d H:i:s", mktime(0, 0, 0, substr($this->period,-2), 1, substr($this->period,0,4)));
		$periodEnd = date("Y-m-d H:i:s", mktime(0, 0, 0, substr($this->period,-2)+1, 1, substr($this->period,0,4)));
		$criterion = $criteria->getNewCriterion(BlogEntryPeer::CREATIONDATE, $periodBegin, Criteria::GREATER_EQUAL);
		$criterion->addAnd($criteria->getNewCriterion(BlogEntryPeer::CREATIONDATE, $periodEnd, Criteria::LESS_THAN));
		$criteria->add($criterion);
	}


	if (!empty($this->fromDate) && ! empty($this->toDate)) {
		$criterion = $criteria->getNewCriterion(BlogEntryPeer::CREATIONDATE, $this->fromDate, Criteria::GREATER_EQUAL);
		$criterion->addAnd($criteria->getNewCriterion(BlogEntryPeer::CREATIONDATE, $this->toDate, Criteria::LESS_EQUAL));
		$criteria->add($criterion);
	}
	else {
		
		if (!empty($this->fromDate))
			$criteria->add(BlogEntryPeer::CREATIONDATE, $this->fromDate, Criteria::GREATER_EQUAL);
		
		if (!empty($this->toDate))
			$criteria->add(BlogEntryPeer::CREATIONDATE,$this->toDate, Criteria::LESS_EQUAL);
	}
	
	if (!empty($this->searchString)) {
		//separamos por palabras
		$words = explode(' ',$this->searchString);
		
		foreach ($words as $word) {
		
			$sql = "( ".BlogEntryPeer::TITLE." like '%".$word."%' )";
			if (!isset($criterionTitle))
				$criterionTitle = $criteria->getNewCriterion(BlogEntryPeer::TITLE,$sql,Criteria::CUSTOM);
			else
				$criterionTitle->addOr($criteria->getNewCriterion(BlogEntryPeer::TITLE,$sql,Criteria::CUSTOM));
			
			if (!isset($criterionBody))
				$criterionBody = $criteria->getNewCriterion(BlogEntryPeer::BODY,"%" . $word . "%",Criteria::LIKE);
			else
				$criterionBody->addOr($criteria->getNewCriterion(BlogEntryPeer::BODY,"%" . $word . "%",Criteria::LIKE));
		}

		$criterionTitle->addOr($criterionBody);
		$criteria->add($criterionTitle);

	}

	return $criteria;
	
	}
	
	/**
	* Obtiene todos los noticias paginados con las opciones de filtro asignadas al peer.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los blogEntries
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1) {  
		if ($perPage == -1)
			$perPage = 	BlogEntry::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = $this->getCriteria();     
		$pager = new PropelPager($cond,"BlogEntryPeer", "doSelect",$page,$perPage);
		return $pager;
	 }
	 
	/**
	* Obtiene todos los noticias paginados para el home.
	*
	* @param int $entriesInHome [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los blogEntries
	*/
	function getAllPaginatedFilteredForHome($entriesInHome=5) {  
	$cond = $this->getCriteria();     
	$pager = new PropelPager($cond,"BlogEntryPeer", "doSelect",1,$entriesInHome);
	return $pager;
	}
	
	/**
	* Devuelve lacantidad de entradas que estan asociadas a una etiqueta
	* @param int $tagId Numero de la etiqueta
	* @param int $status [optional] Estado de las esntradas
	*	@return int Cantidad de entradas asociadas a un aetiqueta
	*/
	public function countAllByTagId($tagId,$status = 0) {
		$criteria = new Criteria();
		$criteria->addJoin(BlogEntryPeer::ID, BlogTagRelationPeer::ENTRYID, Criteria::INNER_JOIN);
		$criteria->add(BlogTagRelationPeer::TAGID,$tagId);
		if ($status != 0)
			$criteria->add(BlogEntryPeer::STATUS,$status);	
		$count = BlogEntryPeer::doCount($criteria);
		return $count;
	}
	
	/**
  * Obtiene todas las entradas agrupadas por mes
  *
  *	@return array Informacion sobre todos los activities
  */
  public function getIncludeArchiveList(){

		$archive = BlogEntryQuery::create()
		  ->orderBy('BlogEntry.Creationdate')
		  ->withColumn('count(BlogEntry.Id)', 'nbEntries')
		  ->withColumn('DATE_FORMAT(BlogEntry.Creationdate,"%Y")', 'ArchiveYear')
		  ->withColumn('DATE_FORMAT(BlogEntry.Creationdate,"%m")', 'ArchiveMonth')
		  ->groupBy('ArchiveYear')
		  ->groupBy('ArchiveMonth')
		  ->select(array('nbEntries','ArchiveYear','ArchiveMonth'))		  
		  ->find()->toArray();
    return $archive;
  }

} // BlogEntry
