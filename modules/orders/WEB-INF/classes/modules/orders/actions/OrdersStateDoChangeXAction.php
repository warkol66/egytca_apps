<?php

class OrdersStateDoChangeXAction extends BaseAction {

	function OrdersStateDoChangeXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$this->template->template = "TemplateAjax.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$modulo = "Orders";

		if (!empty($_SESSION["loginUser"])) {
			$userId = $_SESSION["loginUser"]->getId();
			$affiliateId = 0;
		}
		else {
			$userId = $_SESSION["loginAffiliateUser"]->getId();
			$affiliateId = $_SESSION["loginAffiliateUser"]->getAffiliateId();
		}

		$order = OrderPeer::get($_POST["orderId"]);

		if (empty($order)) {
			return $mapping->findForwardConfig('notExists');
		}

		if (empty($_SESSION["loginUser"])) {
			if ($_SESSION["loginAffiliateUser"]->getAffiliateId() != $order->getAffiliateId())
				return $mapping->findForwardConfig('noPermission');
		}

		if (!empty($order) && !empty($_POST["orderId"]) && $_POST["state"] != "") {
			$stateChange = OrderStateChangePeer::create($_POST["orderId"],$userId,$affiliateId,$_POST["state"],$_POST["comment"]);
			$order->setState($_POST["state"]);
			$order->save();
			$smarty->assign("stateChange",$stateChange);
			$smarty->assign("state",$_POST["state"]);
			$smarty->assign("stateName",OrderPeer::getStateNameFromNumber($_POST["state"]));
			return $mapping->findForwardConfig('success');
		}

		return $mapping->findForwardConfig('failure');
	}

}
