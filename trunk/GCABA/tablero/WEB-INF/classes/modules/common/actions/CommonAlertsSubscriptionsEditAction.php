<?php

class CommonAlertsSubscriptionsEditAction extends BaseAction {

	function CommonAlertsSubscriptionsEditAction() {
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
		
		if (!empty($_GET["id"])) {
			//voy a editar un alertSubscription
			$alertSubscription = AlertSubscriptionPeer::get($_GET["id"]);
			$moduleEntity = $alertSubscription->getModuleEntity();
			$moduleEntityDateFields = $alertSubscription->getPosibleTemporalFields();
			$moduleEntityPosibleNameFields = $alertSubscription->getPosibleNameFields();
			$moduleEntityPosibleBooleanFields = $alertSubscription->getPosibleBooleanFields();
			$smarty->assign('entityDateFields', $moduleEntityDateFields);
			$smarty->assign('entityNameFields', $moduleEntityPosibleNameFields);
			$smarty->assign('entityBooleanFields', $moduleEntityPosibleBooleanFields);														  
			$smarty->assign("action","edit");
		}
		else {
			//voy a crear un alertSubscription
			$alertSubscription = new AlertSubscription();
			$moduleEntity = new ModuleEntity();
			$smarty->assign("action","create");
		}
		$smarty->assign("alertSubscription",$alertSubscription);
		$smarty->assign("moduleEntity",$moduleEntity);

		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("page",$_GET["page"]);
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}
}
