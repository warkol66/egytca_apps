<?php

class BlogCategoriesDoDeleteAction extends BaseDoDeleteAction {

	function __construct() {
		parent::__construct('BlogCategory');
	}
	
	protected function preDelete(){
		parent::preDelete();
		
		$category = BlogCategoryQuery::create()->findOneById($_POST['id']);
		
		if ($category->isRoot()){
			BlogCategoryPeer::deleteTree($category->getScope());
			//return $mapping->findForwardConfig('success');
		}		
			
	}
	/*function BlogCategoriesDoDeleteAction() {
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
		$category = BlogCategoryQuery::create()->findPk($_POST["id"]);
		if ($category->isRoot())
			BlogCategory::deleteTree($category->getScope());
		else		
			BlogCategory::deleteCat($_POST["id"]);
		return $mapping->findForwardConfig('success');
	}*/

}
