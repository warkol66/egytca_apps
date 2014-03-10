<?php

class CommonSchedulesSubscriptionsGetEntityFieldsAction extends BaseSelectAction {
	
	function __construct() {
		parent::__construct('ScheduleSubscription');
	}

	protected function postSelect() {
		parent::postSelect();
		
		if(isset($_GET['entityName'])){
			$entityName = $_GET['entityName'];
			$moduleEntityDateFields = ScheduleSubscription::getPosibleTemporalFieldsByEntityName($entityName);
			$moduleEntityBooleanFields = ScheduleSubscription::getPosibleBooleanFieldsByEntityName($entityName);
			$moduleEntityPosibleNameFields = ScheduleSubscription::getPosibleNameFieldsByEntityName($entityName);

			$this->smarty->assign('entityDateFields', $moduleEntityDateFields);
			$this->smarty->assign('entityNameFields', $moduleEntityPosibleNameFields);
			$this->smarty->assign('entityBooleanFields', $moduleEntityBooleanFields);
		}

	}

}

/*
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
}*/
