<?php

class OrdersViewAction extends BaseAction {

	function OrdersViewAction() {
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

		$module = "Orders";
		$section = "Orders";

		$order = OrderPeer::get($_GET["id"]);
		if (empty($order))
			return $mapping->findForwardConfig('notExists');

		if (empty($_SESSION["loginUser"])) {
			if ($_SESSION["loginAffiliateUser"]->getAffiliateId() != $order->getAffiliateId())
				return $mapping->findForwardConfig('noPermission');
		}

		if (empty($_SESSION["loginUser"]))
			$smarty->assign("all",0);
		else
			$smarty->assign("all",1);

		$smarty->assign("order",$order);

		global $protectedWords;
		$smarty->assign("stateTexts",$protectedWords["orderStates"]);

		return $mapping->findForwardConfig('success');
	}

}
