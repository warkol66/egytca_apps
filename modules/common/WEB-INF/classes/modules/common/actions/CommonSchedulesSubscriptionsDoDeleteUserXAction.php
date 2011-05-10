<?php

class CommonSchedulesSubscriptionsDoDeleteUserXAction extends BaseAction {

	function CommonSchedulesSubscriptionsDoDeleteUserXAction() {
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
		
		$scheduleSubscription = ScheduleSubscriptionPeer::get($_POST['scheduleSubscriptionId']);
		$userId = $_POST["partyId"];

		if ($scheduleSubscription->removeUser($userId) > 0) {
			$smarty->assign('id', $userId);	
		} else {
			$smarty->assign('error', 'no_such_user');
		}
		return $mapping->findForwardConfig('success');
	}

}
