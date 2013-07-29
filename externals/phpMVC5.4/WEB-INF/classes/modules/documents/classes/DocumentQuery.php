<?php



/**
 * Skeleton subclass for performing query and update operations on the 'documents_document' table.
 *
 * Documentos del sistema
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.documents.classes
 */
class DocumentQuery extends BaseDocumentQuery {
	
 /**
	* Agrega filtros por nombre o contenido de una BlogEntry
	*
	* @param   type string $searchString texto a buscar
	* @return condicion de filtrado por texto a buscar
	*/
	public function searchString($searchString) {
		return $this->where("Document.Title LIKE ?", "%$searchString%")
							->_or()
								->where("Document.Description LIKE ?", "%$searchString%")
							->_or()
								->where("Document.Realfilename LIKE ?", "%$searchString%")
							->_or()
								->where("Document.Fulltextcontent LIKE ?", "%$searchString%");
	}

	function filterByNoCategory($comparison = null) {
		return $this->filterByCategoryid(0, $comparison);
	}
	
//	function searchString($value) {
//		//TODO: revisar por que no anda con los campos comentados
//		$fields = DocumentPeer::DESCRIPTION . ',' .
//			DocumentPeer::TITLE . ',' .
//			DocumentPeer::REALFILENAME . ',' .
////			DocumentPeer::AUTHOR . ',' .
//			DocumentPeer::KEYWORDS;// . ',' .
////			DocumentPeer::FULLTEXTCONTENT;
//		
//		return $this->where("CONCAT($fields) LIKE '%$value%'");
//	}

} // DocumentQuery
