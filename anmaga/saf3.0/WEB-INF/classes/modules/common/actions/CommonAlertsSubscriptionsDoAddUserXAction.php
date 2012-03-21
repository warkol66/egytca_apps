<?php

class CommonAlertsSubscriptionsDoAddUserXAction extends BaseAction {

	function CommonAlertsSubscriptionsDoAddUserXAction() {
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

		$user = UserPeer::get($_POST['user']['id']);
		$alertSubscription = AlertSubscriptionPeer::get($_POST['alertSubscriptionId']);
		
		if (!empty($user) && !empty($alertSubscription)) { 
			$alertSubscription->addUser($user);
			if ($alertSubscription->hasUser($user)) 
				$smarty->assign('error', 'duplicated');
			else 
				$alertSubscription->save();
		} else {
			$smarty->assign('error', 'no_such_user');
		}
		$smarty->assign('alertSubscription', $alertSubscription);
		return $mapping->findForwardConfig('success');

	}

}
