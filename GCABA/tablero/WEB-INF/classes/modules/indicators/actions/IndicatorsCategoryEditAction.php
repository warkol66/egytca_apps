<?php

class IndicatorsCategoryEditAction extends BaseAction {

	function IndicatorsCategoryEditAction() {
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

		$module = "Indicators";
		$smarty->assign("module",$module);
		$section = "Categories";
		$smarty->assign("section",$section);

		if ( !empty($_GET["id"]) ) {
			$category = IndicatorCategoryPeer::get($_GET["id"]);
			$smarty->assign("action","edit");
		}
		else {
			$category = new IndicatorCategory();
			$smarty->assign("action","create");
		}

		$smarty->assign("category",$category);
		$smarty->assign("message",$_GET["message"]);

		$categories =  IndicatorCategoryPeer::getAll();
		$smarty->assign("categories",$categories);

		return $mapping->findForwardConfig('success');
	}

}
