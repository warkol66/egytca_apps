<?php

class ActorsEditAction extends BaseAction {

	function ActorsEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Actors";
		$smarty->assign("module",$module);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		if (!empty($_GET["id"])) {
			//voy a editar un objeto

			$actor = ActorPeer::get($_GET["id"]);

			if (!is_null($actor)) {
				if (method_exists($actor,"getActorCategorys")) {
					$actualCategories = $actor->getActorCategorys();
					$smarty->assign("actualCategories",$actualCategories);

					if (!$actualCategories->isEmpty())
						$excludeCategoriesIds = $actor->getAssignedCategoriesArray($_GET["id"]);

					$criteria = new Criteria();
					$criteria->add(ActorCategoryPeer::ID, $excludeCategoriesIds, Criteria::NOT_IN);
					$categoryCandidates = ActorCategoryPeer::doSelect($criteria);
					$smarty->assign("categoryCandidates",$categoryCandidates);
				}
			}
			else
				$actor = new Actor();

			$smarty->assign("actor",$actor);
			$smarty->assign("action","edit");

		}
		else {
			//voy a crear un objeto nuevo
			$actor = new Actor();
			$smarty->assign("actor",$actor);
			$smarty->assign("action","create");
		}

		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("page",$_GET["page"]);
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
