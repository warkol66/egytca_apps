<?php

class CommonSchedulesSubscriptionsDoEditAction extends BaseAction {

	function CommonSchedulesSubscriptionsDoEditAction() {
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

		if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

		if (!empty($_POST["id"])) { // Existing scheduleSubscription
			$scheduleSubscription = ScheduleSubscriptionPeer::get($_POST["id"]);					
		} else { // New scheduleSubscription
			$scheduleSubscription = new ScheduleSubscription();
		}
		Common::setObjectFromParams($scheduleSubscription,$_POST["scheduleSubscription"]);		
		if ($scheduleSubscription->save()) {
			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');
		}
	}
}
