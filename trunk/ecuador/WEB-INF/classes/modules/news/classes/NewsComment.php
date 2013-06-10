<?php

/**
 * Skeleton subclass for representing a row from the 'news_comment' table.
 *
 * Comentarios a noticias
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    news
 */
class NewsComment extends BaseNewsComment {
	
	/*Estados de los comments*/
	const PENDING  = 1;
	const APPROVED = 2;
	const SPAM     = 3;
	const DELETED  = 4;
	
	protected static $statusOptions = array(
		NewsComment::PENDING    => 'Pendiente',
		NewsComment::APPROVED   => 'Aprobado',
		NewsComment::SPAM       => 'SPAM',
		NewsComment::DELETED    => 'Eliminado'
	);

	/**
	 * Devuelve los posibles estados
	 */
	public static function getStatusOptions() {
		$statusOptions = NewsComment::$statusOptions;
		return $statusOptions;
	}
	
	/**
	 * Indica si un comentario se encuentra pendiente
	 * @return boolean
	 */
	public function isPending() {
		return ($this->getStatus() == NewsComment::PENDING);
	}

	/**
	 * Indica si un comentario se encuentra aprobado
	 * @return boolean
	 */
	public function isApproved() {
		return ($this->getStatus() == NewsComment::APPROVED);
	}

	/**
	 * Indica si un comentario esta indicado como spam
	 * @return boolean
	 */
	public function isSpam() {
		return ($this->getStatus() == NewsComment::SPAM);
	}

	/**
	 * Indica si un comentario esta eliminado
	 * @return boolean
	 */
	public function isDeleted() {
		return ($this->getStatus() == NewsComment::DELETED);
	}
	
	public function getLogData(){
		return substr($this->getName(),0,50);
	}

} // NewsComment
