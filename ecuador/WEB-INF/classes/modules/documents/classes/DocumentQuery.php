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
