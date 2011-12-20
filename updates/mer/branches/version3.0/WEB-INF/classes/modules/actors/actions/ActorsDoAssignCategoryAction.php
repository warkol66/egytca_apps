<?php

class ActorsDoAssignCategoryAction extends BaseAction {

	function ActorsDoAssignCategoryAction() {
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

		foreach($_POST["cat"] as $actor=>$category)
			$actorPeer->setCategoryToActor($actor,$category);

		return $mapping->findForwardConfig('success');
	}

}
