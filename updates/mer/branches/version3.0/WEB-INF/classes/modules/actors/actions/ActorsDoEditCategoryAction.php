<?php

class ActorsDoEditCategoryAction extends BaseAction {

	function ActorsDoEditCategoryAction() {
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

		if (!empty($_POST["id"])) {
			$actor = $actorPeer->get($_POST["id"]);
			$actorPeer->saveWithCategory($_POST["id"],$_POST["name"],$_POST["category"]);
		}

		if ($_REQUEST["action"]=="edit")
			return $mapping->findForwardConfig('edit');

		return $mapping->findForwardConfig('success');
	}

}
