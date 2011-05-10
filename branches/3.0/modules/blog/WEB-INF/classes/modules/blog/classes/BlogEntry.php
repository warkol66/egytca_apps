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
		$criteria->add(BlogCommentPeer::STATUS,APPROVED);
		return $criteria;
	}
	
 	/**
     * Code to be run before inserting to database
     * @param PropelPDO $con 
     * @return boolean 
     */
    public function preInsert(PropelPDO $con = null) {
    	$uniqueUrl = BlogEntryPeer::getUrlFromTitle($this->getTitle());
    	$this->setUrl($uniqueUrl);
        return true;
    }

} // BlogEntry
