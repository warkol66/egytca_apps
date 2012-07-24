<?php

class ServicesAlertsSubscriptionsDoEditAction extends BaseAction {

	function ServicesAlertsSubscriptionsDoEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

		if (!empty($_POST["id"])) { // Existing alertSubscription
			$alertSubscription = AlertSubscriptionPeer::get($_POST["id"]);					
		} else { // New alertSubscription
			$alertSubscription = new AlertSubscription();
		}
		Common::setObjectFromParams($alertSubscription,$_POST["alertSubscription"]);		
		if ($alertSubscription->save()) {
			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');
		}
	}
}
