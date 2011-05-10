<?php

class BlogCategoriesEditAction extends BaseAction {

	function BlogCategoriesEditAction() {
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
		$smarty->assign("module",$module);
		$section = "Categories";
		$smarty->assign("section",$section);

		if ( !empty($_GET["id"]) ) {
			$category = BlogCategoryPeer::get($_GET["id"]);
			$smarty->assign("action","edit");
		}
		else {
			$category = new BlogCategory();
			$smarty->assign("action","create");
		}

		$smarty->assign("category",$category);
		$smarty->assign("message",$_GET["message"]);

		$categories =  BlogCategoryPeer::getAll();
		$smarty->assign("categories",$categories);

		return $mapping->findForwardConfig('success');
	}

}
