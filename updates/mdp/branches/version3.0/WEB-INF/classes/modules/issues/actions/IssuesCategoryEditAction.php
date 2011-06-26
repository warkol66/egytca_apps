<?php

class IssuesCategoryEditAction extends BaseAction {

	function IssuesCategoryEditAction() {
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

		$module = "Issues";
		$smarty->assign("module",$module);
		$section = "Categories";
		$smarty->assign("section",$section);

		if (!empty($_GET["id"])) {
			$category = IssueCategoryPeer::get($_GET["id"]);
			if (!is_null($category))
				$smarty->assign("action","edit");
			else
				$smarty->assign("notValidId",true);			
		}
		else {
			$category = new IssueCategory();
			$smarty->assign("action","create");
		}

		$smarty->assign("category",$category);
		$smarty->assign("message",$_GET["message"]);

		$categories =  IssueCategoryPeer::getAll();
		$smarty->assign("categories",$categories);

		return $mapping->findForwardConfig('success');
	}

}
