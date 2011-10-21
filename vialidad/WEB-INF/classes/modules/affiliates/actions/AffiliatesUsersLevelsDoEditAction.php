<?php

class AffiliatesUsersLevelsDoEditAction extends BaseAction {

	function AffiliatesUsersLevelsDoEditAction() {
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
		
		$levelParams = $_POST["params"];
		
		if (!empty($_POST["id"])) {
			$level = AffiliateLevelPeer::get($_POST["id"]);
			$level = Common::setObjectFromParams($level,$levelParams);
			if ($level->isModified() && !$level->save()) {
				$smarty->assign("currentLevel", $level);
				$smarty->assign("message","errorUpdate");
				return $mapping->findForwardConfig('failure');
			}
		}
		else {
			if (!AffiliateLevelPeer::create($levelParams["name"])) {
				$smarty->assign("currentLevel", $level);
				$smarty->assign("message","errorUpdate");
				return $mapping->findForwardConfig('failure');
			}
		}
		return $mapping->findForwardConfig('success');
	}

}
