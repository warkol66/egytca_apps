<?php

class HeadlinesSelectActorRoleAction extends BaseAction {

	function HeadlinesSelectActorRoleAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Headlines";
		$smarty->assign("module",$module);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);
		
		$headlineId = $_GET["headlineId"];
		$actorId = $_GET["actorId"];
		$headlineActor = HeadlineActorPeer::retrieveByPK(
			$_GET["headlineId"], $_GET["actorId"], 0);
		$roles = HeadlinePeer::getHeadlineRoles();

		if (!empty($roles[$_GET["role"]])) {
			$headlineActor->setRole($_GET["role"]);
			$headlineActor->save();
		}
		
		if (!is_null($headlineActor->getRole())) {
			$smarty->assign("role", $headlineActor->getRole());
			$smarty->assign("action", "show");
		}
		
		$smarty->assign("roles", $roles);
		$smarty->assign("headlineId", $headlineId);
		$smarty->assign("actorId", $actorId);

		return $mapping->findForwardConfig('success');
	}

}
