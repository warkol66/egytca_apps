<?php

class OrdersItemsDoEditXAction extends BaseAction {

	function OrdersItemsDoEditXAction() {
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

		if (isset($_GET['orderId']) && isset($_GET['itemId']) && isset($_POST['value'])) {

			$item = OrderItemPeer::get($_GET['itemId']);
			$oldQuantity = $item->getQuantity();
			$order = OrderPeer::get($_GET['orderId']);

			if (!$order->updateQuantityItem($_GET['itemId'],$_POST['value'])) {
				$smarty->assign('value',$oldQuantity);
				return $mapping->findForwardConfig('failure');
			}
			$smarty->assign('item',$item);
			$smarty->assign('itemTotal',$item->getPrice() * $_POST['value']);
			$smarty->assign('value',$_POST['value']);
			$smarty->assign('order',$order);
			return $mapping->findForwardConfig('success');

		}

	}

}
