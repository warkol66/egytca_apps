<?php

class ActorsDoAddWithCategoryAction extends BaseAction {

	function ActorsDoAddWithCategoryAction() {
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

		$actorsArray = $_POST["actors"];
		$categoriesArray = $_POST["categories"];

		$count = 0;

		for($i=0; $i<=count($actorsArray); $i++){
			$actor = $actorsArray[$i];
			$category = $categoriesArray[$i];
			if ( !empty($actor) ) {
				$actorPeer->addWithCategory($actor,$category);
				$count++;
			}
		}

		$smarty->assign("count",$count);

		return $mapping->findForwardConfig('success');
	}

}
