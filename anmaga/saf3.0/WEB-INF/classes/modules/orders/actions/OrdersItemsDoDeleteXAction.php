<?php

class OrdersItemsDoDeleteXAction extends BaseAction {

	function OrdersItemsDoDeleteXAction() {
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

		if (empty($_POST['itemId']) && empty($_POST['orderId']))
			return $mapping->findForwardConfig('failure');

		$smarty->assign("itemId",$_POST['itemId']);

		$order = OrderPeer::get($_POST['orderId']);

		try {
			$order->deleteItem($_POST['itemId']);
		}
		catch (PropelException $exp) {
			return $mapping->findForwardConfig('failure');
		}

		$smarty->assign("order",$order);
		return $mapping->findForwardConfig('success');

	}

}
