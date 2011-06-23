<?php

class ActorsCategoryDoEditAction extends BaseAction {

	function ActorsCategoryDoEditAction() {
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
		$section = "Categories";

		if($_POST["categoryData"]["parentId"] != 0)
			$parentNode = ActorCategoryPeer::get($_POST["categoryData"]["parentId"]);
			
		if ($_POST["action"] == "edit") {
			$actorCategory = ActorCategoryPeer::get($_POST["id"]);
			if (!is_null($actorCategory)) {
				$actorCategory = Common::setNestedSetObjectFromParams($actorCategory,$_POST["categoryData"],$parentNode);
				if ($actorCategory->save())
					return $mapping->findForwardConfig('success');
				else								
					return $mapping->findForwardConfig('failure');
			}
		}
		else {

			$actorCategory = new ActorCategory();
			$actorCategory = Common::setNestedSetObjectFromParams($actorCategory,$_POST["categoryData"],$parentNode);

			if (!$actorCategory->save()) {
				$smarty->assign("category",$actorCategory);
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $mapping->findForwardConfig('failure');
			}

			return $mapping->findForwardConfig('success');
		}

	}

}
