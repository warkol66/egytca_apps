<?php



/**
 * Skeleton subclass for performing query and update operations on the 'blog_entry' table.
 *
 * Entradas del Blog
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.blog.classes
 */
class BlogEntryQuery extends BaseBlogEntryQuery {

 /**
	* Agrega filtros por nombre o contenido de una BlogEntry
	*
	* @param   type string $searchString texto a buscar
	* @return condicion de filtrado por texto a buscar
	*/
	public function searchString($searchString) {
		return $this->where("BlogEntry.Title LIKE ?", "%$searchString%")
							->_or()
								->where("BlogEntry.Body LIKE ?", "%$searchString%");
	}
	
	/**
	* Obtiene todos las etiquetas disponibles para la entrada
	*
	* @param int $id Id de la entrada
	* @return array grupos posibles a elegir
	*/
	function getTagCandidates($id){
		$tags = BlogTagRelationQuery::create()->select("TagId")->filterByEntryId($id)->find();

		$candidates = BlogTagQuery::create()
											->add(BlogTagPeer::ID, $tags, Criteria::NOT_IN)
											->find();
		return $candidates;
	}

	/** Migrado de Peer
	 * Obtiene los ultimos N articulos publicados
	 * @param integer cantidad de ultimos articulos publicados a obtener
	 * @return Array array de instancias de NewsArticle
	 */
	public function getLastEntries($quantity) {
		
		$articles = BlogEntryQuery::create()
						->orderByCreationDate('desc')
						->filterByStatus(BlogEntry::PUBLISHED)
						->limit($quantity)
						->find();
		return $articles;
		
	}

} // BlogEntryQuery
