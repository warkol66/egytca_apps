<?php

class OrdersDoAddToCartAction extends BaseAction {

	function OrdersDoAddToCartAction() {
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
		$section = "Templates";
		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		
    $order = OrderPeer::get($_REQUEST["id"]);
    if (!empty($order)) {

			$items = $_SESSION["orderItems"];

			foreach ($order->getOrderItems() as $currentItem) {
			
				//Como la cantidad en el carrito es en unidad de ventas debo dividir la cantidad por salesUnit para obtener la cantidad a mostrar en el carrito	
				$currentItemProduct = $currentItem->getProduct();				
				$productQuantity = $currentItem->getQuantity() / $currentItemProduct->getSalesUnit();
				$currentItem->setQuantity($productQuantity);				

				$found = false;
				$i = 0;
				//Busco si no esta ya este producto
				while ($i<count($items) && !$found) {
					$item = $items[$i];
					if ($item->getProductCode() == $currentItem->getProductCode()) {
						$actualQuantity = $item->getQuantity();
						$item->setQuantity($actualQuantity + $currentItem->getQuantity());
						$_SESSION["orderItems"][$i] = $item;
						$found = true;
					}
					$i++;
				}
				//Si no estaba, lo agrego
				if (!$found) {
					$orderItem = new OrderItem();
					$orderItem->setProductCode($currentItem->getProductCode());
					$orderItem->setQuantity($currentItem->getQuantity());
		    	$product = ProductPeer::getByCode($orderItem->getProductCode());
		    	$orderItem->setProduct($product);
		    	$orderItem->setPrice($product->getPrice());
					$_SESSION["orderItems"][] = $orderItem;
				}
			
			}
		
		}

		return $mapping->findForwardConfig('success');
	}

}
