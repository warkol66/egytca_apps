<?php

class ServicesSchedulesSubscriptionsDoDeleteUserXAction extends BaseAction {

	function ServicesSchedulesSubscriptionsDoDeleteUserXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$scheduleSubscription = ScheduleSubscriptionPeer::get($_POST['scheduleSubscriptionId']);
		$userId = $_POST["partyId"];

		if ($scheduleSubscription->removeUser($userId) > 0)
			$smarty->assign('id', $userId);
		else
			$smarty->assign('error', 'no_such_user');

		return $mapping->findForwardConfig('success');
	}

}
