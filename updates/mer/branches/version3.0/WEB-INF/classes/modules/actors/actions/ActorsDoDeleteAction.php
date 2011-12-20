<?php

class ActorsDoDeleteAction extends BaseAction {

	function ActorsDoDeleteAction() {
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

		$actorPeer->delete($_REQUEST["actor"]);

		if ($_REQUEST["action"]=="edit")
			return $mapping->findForwardConfig('edit');

		return $mapping->findForwardConfig('success');

	}

}
