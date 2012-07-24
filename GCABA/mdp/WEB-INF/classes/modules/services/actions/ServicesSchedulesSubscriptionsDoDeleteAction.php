<?php

class ServicesSchedulesSubscriptionsDoDeleteAction extends BaseAction {

	function ServicesSchedulesSubscriptionsDoDeleteAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}


		if (ScheduleSubscriptionPeer::delete($_POST["id"]))
			return $mapping->findForwardConfig('success');
		else
			return $mapping->findForwardConfig('failure');	
	}

}
