<?php

class OrdersEditAction extends BaseAction {

	function OrdersEditAction() {
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
		//recuperamos la orden a editar
		$order = OrderPeer::get($_GET["id"]);

		$products = ProductPeer::getAllWithStock();
		$smarty->assign("products",$products);

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

		//recuperamos todos los branches para cierto Mayorista
		$branches = AffiliateBranchPeer::getAllByAffiliateId($order->getAffiliateId());

		$smarty->assign("order",$order);
		$smarty->assign("branches",$branches);
		$smarty->assign("page",$_GET['page']);

		global $protectedWords;
		$smarty->assign("stateTexts",$protectedWords["orderStates"]);

		return $mapping->findForwardConfig('success');
	}

}
