<?php

class IndicatorsCategoryDoEditAction extends BaseAction {

	function IndicatorsCategoryDoEditAction() {
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
		$section = "Categories";

		if ($_POST["action"] == "edit") {

			if (IndicatorCategoryPeer::update($_POST["id"],$_POST["categoryData"]))
				return $mapping->findForwardConfig('success');

		}
		else {

			$result = IndicatorCategoryPeer::create($_POST["categoryData"]);

			if (!$result) {
				$category = new IndicatorCategory();
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
