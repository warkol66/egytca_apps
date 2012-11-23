<?php

class BlogCategoriesDoEditAction extends BaseAction {
	
	/*function __construct() {
		parent::__construct('BlogCategory');
	}
	
	protected function postEdit(){
		
		$module = "Blog";
		$section = "Categories";
		
	}*/

	function BlogCategoriesDoEditAction() {
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
		$section = "Categories";

		if ($_POST["action"] == "edit") {
			
			//categoryData
			if (BlogCategoryPeer::update($_POST["id"],$_POST["params"]))
				return $mapping->findForwardConfig('success');

		}
		else {

			$result = BlogCategoryPeer::create($_POST["params"]);

			if (!$result) {
				$category = new BlogCategory();
				$category->setid($_POST["id"]);
				$category->setname($_POST["name"]);
				$smarty->assign("category",$category);
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $mapping->findForwardConfig('failure');
			}

			return $mapping->findForwardConfig('success');
		}

	}

}
