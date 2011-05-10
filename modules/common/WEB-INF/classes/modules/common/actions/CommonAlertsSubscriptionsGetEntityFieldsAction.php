<?php

class CommonAlertsSubscriptionsGetEntityFieldsAction extends BaseAction {

	function CommonAlertsSubscriptionsGetEntityFieldsAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//por ser una action ajax.
		$this->template->template = "TemplateAjax.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$alertSubscription = AlertSubscriptionPeer::get($_GET['alertSubscriptionId']);
		if (empty($alertSubscription))
			$alertSubscription = new AlertSubscription;

		$entityName = $_GET['entityName'];
		$moduleEntityDateFields = AlertSubscriptionPeer::getPosibleTemporalFieldsByEntityName($entityName);
		$moduleEntityBooleanFields = AlertSubscriptionPeer::getPosibleBooleanFieldsByEntityName($entityName);
		$moduleEntityPosibleNameFields = AlertSubscriptionPeer::getPosibleNameFieldsByEntityName($entityName);
		
		$smarty->assign('entityDateFields', $moduleEntityDateFields);
		$smarty->assign('entityNameFields', $moduleEntityPosibleNameFields);
		$smarty->assign('entityBooleanFields', $moduleEntityBooleanFields);
		$smarty->assign('alertSubscription', $alertSubscription);
		return $mapping->findForwardConfig('success');
	}
}
