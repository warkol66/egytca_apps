<?php

class ActorsDoAddAction extends BaseAction {

	function ActorsDoAddAction() {
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
		$actorsList = $_POST["bulkList"];
		$count = 0;

		foreach(split("\n|\r\n",$actorsList) as $actor){
			if ($actor!='' && !ereg("^ +$",$actor) && !empty($actor)){
				$actorPeer->add($actor);
				$count++;
			}
		}

		$smarty->assign("count",$count);

		return $mapping->findForwardConfig('success');
	}

}
