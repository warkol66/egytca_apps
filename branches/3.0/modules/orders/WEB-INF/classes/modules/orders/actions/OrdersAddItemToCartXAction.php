<?php

class OrdersAddItemToCartXAction extends BaseAction {

	function OrdersAddItemToCartXAction() {
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
		
		$items = $_SESSION["orderItems"];
		$product = ProductPeer::getByCode($_POST["productCode"]);
		$productCode = $product->getCode();

		$found = false;
		$i = 0;
		//Busco si no esta ya este producto
		while ($i<count($items) && !$found) {
			$item = $items[$i];
			if ($item->getProductCode() == $productCode) {
				$actualQuantity = $item->getQuantity();
				$item->setQuantity($actualQuantity + $_POST["quantity"]);
				$_SESSION["orderItems"][$i] = $item;
				$found = true;
			}
			$i++;
		}
		//Si no estaba, lo agrego
		if (!$found) {
			$orderItem = new OrderItem();
			$orderItem->setQuantity($_POST["quantity"]);
    		$orderItem->setProduct($product);
    		$orderItem->setPrice($product->getPrice());
			$_SESSION["orderItems"][] = $orderItem;
		}

		return $mapping->findForwardConfig('success');
	}

}
