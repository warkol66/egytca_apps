<?php

class ActorsSetHierarchyAction extends BaseAction {

	function ActorsSetHierarchyAction() {
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

		if ( !empty($_GET["cat"]) ) {
			$actorPeer = new ActorPeer();
			$actors = $actorPeer->getByCategory($_GET["cat"]);
			$smarty->assign("actors",$actors);
			$smarty->assign("actorsCount",count($actors));
			$smarty->assign("actorsCountPlus1",count($actors)+1);
			$smarty->assign("actorsCountPlus3",count($actors)+3);
			$category = $categoryPeer->get($_GET["cat"]);
			$smarty->assign("currentCategory",$category);
			$principalActors = ActorPeer::getPrincipalActors($_GET["cat"]);
			$smarty->assign("principalActors",$principalActors);
			$smarty->assign("manual",$_GET["manual"]);
		}

		return $mapping->findForwardConfig('success');
	}

}
