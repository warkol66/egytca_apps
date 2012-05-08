<?php

class ActorsCategoryEditAction extends BaseAction {

	function ActorsCategoryEditAction() {
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

		$module = "Actors";
		$smarty->assign("module",$module);
		$section = "Categories";
		$smarty->assign("section",$section);

		if (!empty($_GET["id"])) {
			$category = ActorCategoryPeer::get($_GET["id"]);
			if (!is_null($category))
				$smarty->assign("action","edit");
			else
				$smarty->assign("notValidId",true);			
		}
		else {
			$category = new ActorCategory();
			$smarty->assign("action","create");
		}

		$smarty->assign("category",$category);
		$smarty->assign("message",$_GET["message"]);

		$categories =  ActorCategoryPeer::getAll();
		$smarty->assign("categories",$categories);

		return $mapping->findForwardConfig('success');
	}

}
