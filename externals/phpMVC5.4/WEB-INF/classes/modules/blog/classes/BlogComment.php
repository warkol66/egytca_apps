<?php

/**
 * Skeleton subclass for representing a row from the 'blog_comment' table.
 *
 * Comentarios a entradas
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.blog.classes
 */
class BlogComment extends BaseBlogComment {
	
	private $entryId;
	private $commentStatus;
	private $toDate;
	private $fromDate;
	
	/*Estados de los comments*/
	const PENDING  = 1;
	const APPROVED = 2;
	const SPAM     = 3;
	const DELETED  = 4;
	
	protected static $statusOptions = array(
		BlogComment::PENDING    => 'Pendiente',
		BlogComment::APPROVED   => 'Aprobado',
		BlogComment::SPAM       => 'SPAM',
		BlogComment::DELETED    => 'Eliminado'
	);

	/**
	 * Devuelve los posibles estados
	 */
	public static function getStatusOptions() {
		$statusOptions = BlogComment::$statusOptions;
		return $statusOptions;
	}

	/**
	 * Indica si un comentario se encuentra pendiente
	 * @return boolean
	 */
	public function isPending() {
		return ($this->getStatus() == BlogComment::PENDING);
	}

	/**
	 * Indica si un comentario se encuentra aprobado
	 * @return boolean
	 */
	public function isApproved() {
		return ($this->getStatus() == BlogComment::APPROVED);
	}

	/**
	 * Indica si un comentario esta indicado como spam
	 * @return boolean
	 */
	public function isSpam() {
		return ($this->getStatus() == BlogComment::SPAM);
	}

	/**
	 * Indica si un comentario esta eliminado
	 * @return boolean
	 */
	public function isDeleted() {
		return ($this->getStatus() == BlogComment::DELETED);
	}
	
	/**
	 * Define un id de articulo para la creacion de una criteria de busqueda
	 * @param integer id de articulo
	 */
	public function setCommentEntryId($entryId) {
		$this->entryId = $entryId;
		return true;
	}

	/**
	 * Define un status para la creacion de una criteria de busqueda
	 * @param integer status de comentario
	 */
	public function setCommentStatus($commentStatus) {
		$this->status = $commentStatus;
		return true;
	}

	/**
	 * Especifica una fecha desde para una busqueda personalizada.
	 *
	 * @param $fromDate string YYYY-MM-DD
	 */
	public function setCommentFromDate($fromDate) {
		$this->fromDate = $fromDate;
	}

	/**
	 * Especifica una fecha hasta para una busqueda personalizada.
	 *
	 * @param $toDate string YYYY-MM-DD
	 */
	public function setCommentToDate($toDate) {
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
		$criteria->add(BlogCommentPeer::STATUS,BlogComment::APPROVED);
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
	* Actualiza un comentario
	*
	* @param blogComment
	*	@return boolean true si se creo correctamente el blogComment, false sino
	*/
	function update($id,$params) {
		$blogComment = BlogCommentQuery::create()->findOneById($id);
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
	
	public function getLogData(){
		return substr($this->getName(),0,50);
	}

} // BlogComment
