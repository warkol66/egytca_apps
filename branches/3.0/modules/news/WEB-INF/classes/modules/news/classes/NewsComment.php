<?php

require_once 'om/BaseNewsComment.php';

//estados posibles de los comentarios

define('NEWSCOMMENT_PENDING',1);
define('NEWSCOMMENT_APPROVED',2);
define('NEWSCOMMENT_SPAM',3);
define('NEWSCOMMENT_DELETED',4);

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
	
	/**
	 * Indica si un comentario se encuentra pendiente
	 * @return boolean
	 */
	public function isPending() {
		return ($this->getStatus() == NEWSCOMMENT_PENDING);
	}

	/**
	 * Indica si un comentario se encuentra aprobado
	 * @return boolean
	 */
	public function isApproved() {
		return ($this->getStatus() == NEWSCOMMENT_APPROVED);
	}

	/**
	 * Indica si un comentario esta indicado como spam
	 * @return boolean
	 */
	public function isSpam() {
		return ($this->getStatus() == NEWSCOMMENT_SPAM);
	}

	/**
	 * Indica si un comentario esta eliminado
	 * @return boolean
	 */
	public function isDeleted() {
		return ($this->getStatus() == NEWSCOMMENT_DELETED);
	}

} // NewsComment
