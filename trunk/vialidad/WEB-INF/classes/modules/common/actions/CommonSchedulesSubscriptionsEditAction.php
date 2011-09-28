<?php

class CommonSchedulesSubscriptionsEditAction extends BaseAction {

	function CommonSchedulesSubscriptionsEditAction() {
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
			//voy a editar un scheduleSubscription
			$scheduleSubscription = ScheduleSubscriptionPeer::get($_GET["id"]);
			$moduleEntity = $scheduleSubscription->getModuleEntity();
			$moduleEntityDateFields = $scheduleSubscription->getPosibleTemporalFields();
			$moduleEntityPosibleNameFields = $scheduleSubscription->getPosibleNameFields();
			$moduleEntityPosibleBooleanFields = $scheduleSubscription->getPosibleBooleanFields();
			$smarty->assign('entityDateFields', $moduleEntityDateFields);
			$smarty->assign('entityNameFields', $moduleEntityPosibleNameFields);
			$smarty->assign('entityBooleanFields', $moduleEntityPosibleBooleanFields);														  
			$smarty->assign("action","edit");
		}
		else {
			//voy a crear un scheduleSubscription
			$scheduleSubscription = new ScheduleSubscription();
			$moduleEntity = new ModuleEntity();
			$smarty->assign("action","create");
		}
		$smarty->assign("scheduleSubscription",$scheduleSubscription);
		$smarty->assign("moduleEntity",$moduleEntity);

		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("page",$_GET["page"]);
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}
}
