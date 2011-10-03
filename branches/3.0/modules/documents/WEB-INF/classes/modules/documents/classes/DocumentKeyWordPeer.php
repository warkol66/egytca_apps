<?php

/**
 * Skeleton subclass for performing query and update operations on the 'documents_keyWord' table.
 *
 * Palabras clave de documentos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    documents.classes
 */
class DocumentKeyWordPeer extends BaseDocumentKeyWordPeer {

	function getAll() {
		$criteria = new Criteria();
		$allObj = DocumentKeyWordPeer::doSelect($criteria);
		return $allObj;
	}

	function get($id) {
   	$obj = DocumentKeyWordPeer::retrieveByPK($id);
		return $obj;
	}

	/**
	 * Crea una nueva instancia del documento y lleva a cabo la carga de la misma
	 *
	 * @param string keyWord
	 * @return false en caso de error, o la instancia creada.
	 */
	function create($keyWord) {

		try {
			$keyWordObj = new DocumentKeyWord();
			$keyWordObj->setKeyWord($keyWord);
			$keyWordObj->save();
		} 
		catch (PropelException $e) {
			return false;
		}
		
		return $keyWordObj;
	}

	function update($id,$keyWord) {

		try {
			$keyWordObj = DocumentKeyWordPeer::retrieveByPK($id);
			$keyWordObj->setKeyWord($keyWord);
			$keyWordObj->save();
		}
		catch (PropelException $exp) {
			return false;
		}

		return true;
	}



} // DocumentKeyWordPeer
