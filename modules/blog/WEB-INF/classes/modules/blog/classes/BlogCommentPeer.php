<?php



/**
 * Skeleton subclass for performing query and update operations on the 'blog_comment' table.
 *
 * Comentarios a entradas
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.blog.classes
 */
class BlogCommentPeer extends BaseBlogCommentPeer {

	const PENDING  = 1;
	const APPROVED = 2;
	const SPAM     = 3;
	const DELETED  = 4;

	private $entryId;
	private $status;
	private $toDate;
	private $fromDate;

	protected static $statusOptions = array(
						BlogCommentPeer::PENDING    => 'Pendiente',
						BlogCommentPeer::APPROVED   => 'Aprobado',
						BlogCommentPeer::SPAM       => 'SPAM',
						BlogCommentPeer::DELETED    => 'Eliminado'
					);

	/**
	 * Devuelve los posibles estados
	 */
	public static function getStatusOptions() {
		$statusOptions = BlogCommentPeer::$statusOptions;
		return $statusOptions;
	}

  /**
  * Obtiene la informacion de un noticia.
  *
  * @param int $id id del blogEntry
  * @return array Informacion del blogEntry
  */
  function get($id) {
		$blogCommentObj = BlogCommentPeer::retrieveByPK($id);
    return $blogCommentObj;
  }

	/**
	 * Define un id de articulo para la creacion de una criteria de busqueda
	 * @param integer id de articulo
	 */
	public function setEntryId($entryId) {
		$this->entryId = $entryId;
		return true;
	}

	/**
	 * Define un status para la creacion de una criteria de busqueda
	 * @param integer status de comentario
	 */
	public function setStatus($status) {
		$this->status = $status;
		return true;
	}

	/**
	 * Especifica una fecha desde para una busqueda personalizada.
	 *
	 * @param $fromDate string YYYY-MM-DD
	 */
	public function setFromDate($fromDate) {
		$this->fromDate = $fromDate;
	}

	/**
	 * Especifica una fecha hasta para una busqueda personalizada.
	 *
	 * @param $toDate string YYYY-MM-DD
	 */
	public function setToDate($toDate) {
		$this->toDate = $toDate;
	}


	/**
	* Obtiene la cantidad de filas por pagina por defecto en los listado paginados.
	*
	* @return int Cantidad de filas por pagina
	*/
	function getRowsPerPage() {
		global $system;
		return $system["config"]["system"]["rowsPerPage"];
	}
	/**
	 * Obtiene todos los comentarios aprobados por articulo
	 * @param integer $articleId
	 * @return array instancias de NewsComment
	 */
	function getAllApprovedByEntry($entryId) {

		$criteria = new Criteria();
		$criteria->addAscendingOrderByColumn(BlogCommentPeer::ENTRYID);
		$criteria->addAscendingOrderByColumn(BlogCommentPeer::CREATIONDATE);
		$criteria->add(BlogCommentPeer::ENTRYID,$entryId);
		$criteria->add(BlogCommentPeer::STATUS,BlogCommentPeer::APPROVED);
		return BlogCommentPeer::doSelect($criteria);

	}

	/**
	 * Devuelve una criteria para utilizar a partir de los valores de
	 * filtro indicados en la instancia
	 * @return Criteria instancia de criteria.
	 */
	private function getCriteria() {
		$criteria = new Criteria();

		if (!empty($this->entryId))
			$criteria->add(BlogCommentPeer::ENTRYID,$this->entryId);

		if (!empty($this->status))
			$criteria->add(BlogCommentPeer::STATUS,$this->status);
		else
			$criteria->add(BlogCommentPeer::STATUS,BlogCommentPeer::SPAM,Criteria::NOT_EQUAL);

		if (!empty($this->fromDate) && ! empty($this->toDate)) {
			$criterion = $criteria->getNewCriterion(BlogCommentPeer::CREATIONDATE, $this->fromDate . ' 00:00:00', Criteria::GREATER_EQUAL);
			$criterion->addAnd($criteria->getNewCriterion(BlogCommentPeer::CREATIONDATE, $this->toDate . ' 24:59:59', Criteria::LESS_EQUAL));
			$criteria->add($criterion);
		}
		else {

			if (!empty($this->fromDate))
				$criteria->add(BlogCommentPeer::CREATIONDATE, $this->fromDate . ' 00:00:00', Criteria::GREATER_EQUAL);

			if (!empty($this->toDate))
				$criteria->add(BlogCommentPeer::CREATIONDATE,$this->toDate . ' 24:59:59', Criteria::LESS_EQUAL);
		}

		$criteria->addDescendingOrderByColumn(BlogCommentPeer::CREATIONDATE);
		return $criteria;

	}

	/**
	* Obtiene todos los comentarios paginados.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los blogComments
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = 	BlogCommentPeer::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = $this->getCriteria();
		$pager = new PropelPager($cond,"BlogCommentPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

	/**
	* Elimina un comentario a partir de los valores de la clave.
	*
	* @param int $id id del blogComment
	*	@return boolean true si se elimino correctamente el blogComment, false sino
	*/
	function delete($id) {
		$blogComment = BlogCommentPeer::retrieveByPK($id);
		$blogComment->delete();
		return true;
	}

	/**
	* Crea un comentario
	*
	* @param blogComment
	*	@return boolean true si se creo correctamente el blogComment, false sino
	*/
	function create($params) {
		$blogComment = new BlogComment();
		$blogComment = Common::setObjectFromParams($blogComment,$params);		
		try {
			$blogComment->save();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Actualiza un comentario
	*
	* @param blogComment
	*	@return boolean true si se creo correctamente el blogComment, false sino
	*/
	function update($id,$params) {
		$blogComment = BlogCommentPeer::get($id);
		$blogComment = Common::setObjectFromParams($blogComment,$params);		
		try {
			$blogComment->save();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

} // BlogCommentPeer
