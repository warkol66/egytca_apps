<?php

class OrdersChangeItemCartXAction extends BaseAction {

	function OrdersChangeItemCartXAction() {
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

		$found = false;
		$i = 0;
		//Busco el producto
		while ($i<count($items) && !$found) {
			$item = $items[$i];
			if ($item->getProductCode() == $_POST["productCode"]) {
				$item->setQuantity($_POST["quantity"]);
    			$_SESSION["orderItems"][$i] = $item;
				$found = true;
			}
			$i++;
		}
		//Si no estaba, no hago nada
		if (!$found) {

		} else {
			$items = $_SESSION["orderItems"];
			$total = 0;
			foreach ($items as $item) {
				if (!empty($item)) {
					$product = $item->getProduct();
					$total += ($product->getPrice() * $product->getSalesUnit() * $item->getQuantity());
				}
			}
			$smarty->assign("total",$total);		
		}

		return $mapping->findForwardConfig('success');
	}

}
