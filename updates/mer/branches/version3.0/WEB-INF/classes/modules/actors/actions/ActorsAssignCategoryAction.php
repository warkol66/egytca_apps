<?php

class ActorsAssignCategoryAction extends BaseAction {

	function ActorsAssignCategoryAction() {
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
		$section = "Configure";

		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		$categoryPeer = new CategoryPeer();
		$categories = $categoryPeer->getUserCategories($_SESSION["login_user"]);
		$smarty->assign("categories",$categories);

		$actorPeer = new ActorPeer();
		$actors = $actorPeer->getActorsWithNoCategory();
		$smarty->assign("actors",$actors);

		if (!empty($_GET["cat"])) {
			$actorsCategory = $actorPeer->getByCategory($_GET["cat"]);
			$smarty->assign("actorsCategory",$actorsCategory);
			$category = $categoryPeer->get($_GET["cat"]);
			$smarty->assign("currentCategory",$category);
		}

		return $mapping->findForwardConfig('success');
	}

}
