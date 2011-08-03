<?php

class HeadlinesEditAction extends BaseAction {

	function HeadlineEditAction() {
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

		$module = "Headlines";
		$smarty->assign("module",$module);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		if (!empty($_GET["id"])) {
			//voy a editar un objeto

			$headline = HeadlinePeer::get($_GET["id"]);

			if (!is_null($headline)) {
				/*$actualCategories = $actor->getActorCategorys();
				$smarty->assign("actualCategories",$actualCategories);

				if (!$actualCategories->isEmpty())
					$excludeCategoriesIds = $actor->getAssignedCategoriesArray($_GET["id"]);

				$criteria = new Criteria();
				$criteria->add(ActorCategoryPeer::ID, $excludeCategoriesIds, Criteria::NOT_IN);
				$categoryCandidates = ActorCategoryPeer::doSelect($criteria);
				$smarty->assign("categoryCandidates",$categoryCandidates);*/

			}
			else
				$headline = new Headline();

			$smarty->assign("headline",$headline);
			$smarty->assign("action","edit");

		}
		else {
			//voy a crear un objeto nuevo
			$headline = new Headline();
			$smarty->assign("headline",$headline);
			$smarty->assign("action","create");
		}

		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("page",$_GET["page"]);
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
