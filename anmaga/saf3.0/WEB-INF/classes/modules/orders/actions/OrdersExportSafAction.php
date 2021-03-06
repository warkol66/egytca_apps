<?php

class OrdersExportSafAction extends BaseAction {

	function OrdersExportSafAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$this->template->template = "TemplateCsv.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Orders";
		$smarty->assign("module",$module);

		if (!empty($_SESSION["loginUser"])) {
			$userId = $_SESSION["loginUser"]->getId();
			$affiliateId = 0;
		}

		global $system;
		$exportComment = $system['config']['orders']['exportComment'];

		$orderPeer = new OrderPeer();

		$idOrders = $_REQUEST["orders"];
		
		$orders = array();
		foreach ($idOrders as $id) {
			$order = OrderPeer::get($id);
			if (!empty($order) && (!empty($_SESSION["loginUser"]) || (empty($_SESSION["loginUser"]) && ($_SESSION["loginAffiliateUser"]->getAffiliateId() == $order->getAffiliateId())))) {
				$orders[] = $order;
				$order->setState(OrderPeer::STATE_EXPORTED);
				$order->save();
				OrderStateChangePeer::create($id,$userId,$affiliateId,OrderPeer::STATE_EXPORTED,$exportComment);
			}
		}
		if(count($idOrders) > 0) 
			$smarty->assign("orderItems", OrderItemPeer::getAllByOrders($idOrders));

		$smarty->assign("orders",$orders);

		$articlesPerOrder = $system['config']['orders']['articlesPerOrder'];
		$smarty->assign("articlesPerOrder",$articlesPerOrder);
		$profitCode = $system['config']['orders']['profitCode'];
		$smarty->assign("profitCode",$profitCode);
		$profitRoot = $system['config']['orders']['profitRoot'];
		$smarty->assign("profitRoot",$profitRoot);
		$siteShortName = $system['config']['system']['parameters']['siteShortName'];
		$smarty->assign("siteShortName",$siteShortName);

		header("content-Type:text/html; charset=windows-1252");
		header("content-disposition: attachment; filename=orders$siteShortName.xml");

		return $mapping->findForwardConfig('success');
	}

}
