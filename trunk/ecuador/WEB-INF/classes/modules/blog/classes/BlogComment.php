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

	/**
	 * Indica si un comentario se encuentra pendiente
	 * @return boolean
	 */
	public function isPending() {
		return ($this->getStatus() == BlogCommentPeer::PENDING);
	}

	/**
	 * Indica si un comentario se encuentra aprobado
	 * @return boolean
	 */
	public function isApproved() {
		return ($this->getStatus() == BlogCommentPeer::APPROVED);
	}

	/**
	 * Indica si un comentario esta indicado como spam
	 * @return boolean
	 */
	public function isSpam() {
		return ($this->getStatus() == BlogCommentPeer::SPAM);
	}

	/**
	 * Indica si un comentario esta eliminado
	 * @return boolean
	 */
	public function isDeleted() {
		return ($this->getStatus() == BlogCommentPeer::DELETED);
	}

} // BlogComment
