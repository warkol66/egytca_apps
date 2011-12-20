<?php

class ActorsAddAction extends BaseAction {

	function ActorsAddAction() {
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

		$user = $_SESSION["login_user"];
		$categories = $user->getCategories();

		$smarty->assign("categories",$categories);
		$smarty->assign("countActors",7);

		return $mapping->findForwardConfig('success');
	}

}

