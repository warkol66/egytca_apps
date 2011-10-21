<?php

class AffiliatesUsersLevelsListAction extends BaseAction {

	function AffiliatesUsersLevelsListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Affiliates";
		$section = "Levels";
		
    $smarty->assign("module",$module);
    $smarty->assign("section",$section);

		$groupPeer = new GroupPeer();
		$levels = AffiliateLevelPeer::getAll();
		$smarty->assign("levels",$levels);

    $smarty->assign("message",$_GET["message"]);

    if (!empty($_GET["level"])) {
			try {
				$level = AffiliateLevelPeer::get($_GET["level"]);
				$smarty->assign("currentLevel",$level);
	    	$smarty->assign("action","edit");
	  	}
			catch (PropelException $e) {
			}
		}

		return $mapping->findForwardConfig('success');
	}

}
