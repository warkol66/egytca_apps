<?php

class ServicesAlertsSubscriptionsDoDeleteUserXAction extends BaseAction {

	function ServicesAlertsSubscriptionsDoDeleteUserXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$alertSubscription = AlertSubscriptionPeer::get($_POST['alertSubscriptionId']);
		$userId = $_POST["partyId"];

		if ($alertSubscription->removeUser($userId) > 0) {
			$smarty->assign('id', $userId);	
		} else {
			$smarty->assign('error', 'no_such_user');
		}
		return $mapping->findForwardConfig('success');
	}

}
