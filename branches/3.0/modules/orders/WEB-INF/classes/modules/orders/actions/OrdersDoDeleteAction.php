<?php

class OrdersDoDeleteAction extends BaseAction {

	function OrdersDoDeleteAction() {
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

		$orderPeer = new OrderPeer();
		
		$idOrders = $_REQUEST["orders"];
		
		$orders = array();
		foreach ($idOrders as $id) {
			$order = OrderPeer::get($id);
			if (!empty($order) && (!empty($_SESSION["loginUser"]) || (empty($_SESSION["loginUser"]) && ($_SESSION["loginAffiliateUser"]->getAffiliateId() == $order->getAffiliateId())))) {
				
				try {
					$order->delete();
				}
				catch (PropelException $exp) {
					return $mapping->findForwardConfig('failure');
				}
			}						
		}
		
		$smarty->assign("message","orders_deleted_ok");
		return $mapping->findForwardConfig('success');
	}

}
