<?php

class ServicesSchedulesSubscriptionsDoAddUserXAction extends BaseAction {

	function ServicesSchedulesSubscriptionsDoAddUserXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$user = UserPeer::get($_POST['user']['id']);
		$scheduleSubscription = ScheduleSubscriptionPeer::get($_POST['scheduleSubscriptionId']);
		
		if (!empty($user) && !empty($scheduleSubscription)) { 
			$scheduleSubscription->addUser($user);
			if ($scheduleSubscription->hasUser($user)) 
				$smarty->assign('error', 'duplicated');
			else 
				$scheduleSubscription->save();
		}
		else
			$smarty->assign('error', 'no_such_user');

		$smarty->assign('scheduleSubscription', $scheduleSubscription);
		return $mapping->findForwardConfig('success');

	}

}
