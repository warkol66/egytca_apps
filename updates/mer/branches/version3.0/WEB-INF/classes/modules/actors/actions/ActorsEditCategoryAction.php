<?php

class ActorsEditCategoryAction extends BaseAction {

	function ActorsEditCategoryAction() {
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

		$actorPeer = new ActorPeer();

		if ( !empty($_GET["actor"]) ) {
			$actor = $actorPeer->get($_GET["actor"]);
			$smarty->assign("actor",$actor);
		}

		$categoryPeer = new CategoryPeer();
		$categories = $categoryPeer->getUserCategories($_SESSION["login_user"]);
		$smarty->assign("categories",$categories);

		if ($_REQUEST["action"]=="edit")
			return $mapping->findForwardConfig('edit');

		return $mapping->findForwardConfig('success');
	}

}
