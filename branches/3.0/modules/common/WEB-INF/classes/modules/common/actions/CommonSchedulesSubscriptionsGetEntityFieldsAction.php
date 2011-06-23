<?php

class CommonSchedulesSubscriptionsGetEntityFieldsAction extends BaseAction {

	function CommonSchedulesSubscriptionsGetEntityFieldsAction() {
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

		$scheduleSubscription = ScheduleSubscriptionPeer::get($_GET['scheduleSubscriptionId']);
		if (empty($scheduleSubscription))
			$scheduleSubscription = new ScheduleSubscription;

		$entityName = $_GET['entityName'];
		$moduleEntityDateFields = ScheduleSubscriptionPeer::getPosibleTemporalFieldsByEntityName($entityName);
		$moduleEntityBooleanFields = ScheduleSubscriptionPeer::getPosibleBooleanFieldsByEntityName($entityName);
		$moduleEntityPosibleNameFields = ScheduleSubscriptionPeer::getPosibleNameFieldsByEntityName($entityName);

		$smarty->assign('entityDateFields', $moduleEntityDateFields);
		$smarty->assign('entityNameFields', $moduleEntityPosibleNameFields);
		$smarty->assign('entityBooleanFields', $moduleEntityBooleanFields);
		$smarty->assign('scheduleSubscription', $scheduleSubscription);
		return $mapping->findForwardConfig('success');
	}
}
