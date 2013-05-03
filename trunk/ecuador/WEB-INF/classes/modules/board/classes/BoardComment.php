<?php



/**
 * Skeleton subclass for representing a row from the 'board_comment' table.
 *
 * Comentarios a challenges
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.board.classes
 */
class BoardComment extends BaseBoardComment{
	
	/*Estados de los comments*/
	const PENDING  = 1;
	const APPROVED = 2;
	const SPAM     = 3;
	const DELETED  = 4;
	
	protected static $statusOptions = array(
		BoardComment::PENDING    => 'Pendiente',
		BoardComment::APPROVED   => 'Aprobado',
		BoardComment::SPAM       => 'SPAM',
		BoardComment::DELETED    => 'Eliminado'
	);

	/**
	 * Devuelve los posibles estados
	 */
	public static function getStatusOptions() {
		$statusOptions = BoardComment::$statusOptions;
		return $statusOptions;
	}
	
	/**
	 * Indica si un comentario se encuentra pendiente
	 * @return boolean
	 */
	public function isPending() {
		return ($this->getStatus() == BoardComment::PENDING);
	}

	/**
	 * Indica si un comentario se encuentra aprobado
	 * @return boolean
	 */
	public function isApproved() {
		return ($this->getStatus() == BoardComment::APPROVED);
	}

	/**
	 * Indica si un comentario esta indicado como spam
	 * @return boolean
	 */
	public function isSpam() {
		return ($this->getStatus() == BoardComment::SPAM);
	}

	/**
	 * Indica si un comentario esta eliminado
	 * @return boolean
	 */
	public function isDeleted() {
		return ($this->getStatus() == BoardComment::DELETED);
	}
	
	public static function selectChildren($id) {
		$children = BoardCommentQuery::create()->filterByParentId($id)->find();
		return $children;
	}
}
