<?php

class ActorsDoAddInCategoryAction extends BaseAction {

	function ActorsDoAddInCategoryAction() {
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

		$category = $_POST["cat"];
		$actor = $_POST["anombre"];

		if (!empty($category) && !empty($actor))
			$actorPeer->addWithCategory($actor,$category);

		header("Location: Main.php?do=actorsAddActorInCategory&cat=".$category);
		exit;

		return $mapping->findForwardConfig('success');
	}

}
