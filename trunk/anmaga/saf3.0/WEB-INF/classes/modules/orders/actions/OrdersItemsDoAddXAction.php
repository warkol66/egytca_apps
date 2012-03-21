<?php

class OrdersItemsDoAddXAction extends BaseAction {

	function OrdersItemsDoAddXAction() {
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

		if (empty($order))
			return $mapping->findForwardConfig('notExists');

		if (empty($_SESSION["loginUser"])) {
			if ($_SESSION["loginAffiliateUser"]->getAffiliateId() != $order->getAffiliateId())
				return $mapping->findForwardConfig('noPermission');
		}

		//verificamos producto
		if (isset($_POST['productId']) && (isset($_POST['productQuantity']))) {

			$product = ProductPeer::get($_POST['productId']);
			$order = OrderPeer::get($_POST["orderId"]);

			if (empty($product) || empty($order))
				return $mapping->findForwardConfig('failure');

			try {
				//damos el alta del producto
				$item = $order->addItem($product->getCode(),$product->getPrice(),$_POST['productQuantity']);
			}
			catch(PropelException $exp) {
				//hubo una excepcion
				return $mapping->findForwardConfig('failure');
			}

			if ($item == false)
				//fallo una regla negocio
				return $mapping->findForwardConfig('failure');

			//asignamos a smarty
			$smarty->assign('product',$product);
			$smarty->assign('order',$order);
			$smarty->assign('item',$item);

			return $mapping->findForwardConfig('success');

		}
		else
			return $mapping->findForwardConfig('failure');
	}

}
