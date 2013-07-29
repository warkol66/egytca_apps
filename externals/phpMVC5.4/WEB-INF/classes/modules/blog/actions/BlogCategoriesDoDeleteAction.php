<?php

class BlogCategoriesDoDeleteAction extends BaseAction {

	/*function __construct() {
		parent::__construct('BlogCategory');
	}
	
	protected function preDelete(){
		parent::preDelete();
		
		$category = BlogCategoryQuery::create()->findOneById($_POST['id']);
		
		if ($category->isRoot()){
			//solucion temporal: eliminar descendientes y hacer que no sea root (propel no permite eliminar roots)
			$category->deleteDescendants();
			$category->setLeftValue(0)->save();
		}		
			
	}*/
	
	function BlogCategoriesDoDeleteAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Blog";
		$category = BlogCategoryQuery::create()->findOneById($_POST["id"]);
		if ($category->isRoot())
			BlogCategoryPeer::deleteTree($category->getScope());
		else		
			BlogCategory::delete($_POST["id"]);
		return $mapping->findForwardConfig('success');
	}

}
