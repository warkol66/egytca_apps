<?php

class BlogCategoriesDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('BlogCategory');
	}
	
	protected function postUpdate(){
		
		$module = "Blog";
		$section = "Categories";
		
		//Arreglar cambio o asignacion de padre a uno existente (uodate)
		if($_POST['action'] == 'edit')
			BlogCategory::updateCat($_POST["id"],$_POST["params"]);
		else
			BlogCategory::createCat($id = $this->entity->getId(),$_POST["params"]);	
	}

	/*function BlogCategoriesDoEditAction() {
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
			if (BlogCategory::updateCat($_POST["id"],$_POST["params"]))
				return $mapping->findForwardConfig('success');

		}
		else {

			$result = BlogCategory::createCat($_POST["params"]);

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

	}*/

}
