<?php



/**
 * Skeleton subclass for representing a row from the 'blog_tag' table.
 *
 * Etioquetas de blog
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.blog.classes
 */
class BlogTag extends BaseBlogTag {

	/**
	* Obtiene el nombre del padre de un BlogCategory.
	*
	* @return array Informacion del BlogCategory
	*/
	function getPublishedEntries(){	
		$crieria = BlogEntryQuery::create()->filterByStatus(BlogEntry::PUBLISHED);
		$count = BlogTag::countBlogEntrys($crieria);
		return $count;
	}

	/**
	 * Especifica un peso para la etiqueta
	 * @param weight int peso de busqueda.
	 */
	public function setWeight($weight){
		$this->getWeight = $weight;
	}
	
	public function getLogData(){
		return substr($this->getName(),0,50);
	}

} // BlogTag
