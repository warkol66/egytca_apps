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
}
