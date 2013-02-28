<?php
/**
* DocumentsInclude
*
*  Action utilizado para mostrar los documentos existentes dentro de una categoría
* 
* @package documents
*/

require_once("DocumentPeer.php");
require_once("CategoryPeer.php");

class DocumentsInclude extends DocumentPeer {

	function getCategoryList($options) {
		
		if ($options['categoryId']) {
			
			$categoryPeer = new CategoryPeer();
			$category = $categoryPeer->get($options['categoryId']);
			$partialCategories = $category->getChildrenPublicCategories();
			
			$return = array();
			$return['category'] = $category;
			$return['partialCategories'] = $partialCategories;
			
			return $return;
		}
		
		$generalParentCategories = parent::getGeneralPublicParentCategories();
		$modules = parent::getModulesWithDocuments();
		$documentsWithoutCategoryCount = parent::getDocumentsWithoutCategoryCount();
		
		$return = array();
		$return['documentsWithoutCategoryCount'] = $documentsWithoutCategoryCount;
		$return['generalParentCategories'] = $generalParentCategories;
		$return['modules'] = $modules;
		
		return $return;
		
	}
	
	function getByCategory($options) {
		
		$categoryPeer = new CategoryPeer();
		$category = $categoryPeer->get($options['categoryId']);
		parent::setCategory($category);
		
		$documents = parent::getAllFiltered($category);
		$result = array();
		$result['documents'] = $documents;
		$result['category'] = $category;
		return $result;
		
		
	}

	function getKeyWordList($options) {
		if (class_exists("DocumentKeyWordPeer"))
			$results = DocumentKeyWordPeer::getAll();
		return $results;
	}


}
