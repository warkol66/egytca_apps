<?php

class OrdersRemoveItemCartXAction extends BaseAction {

	function OrdersRemoveItemCartXAction() {
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

		$smarty->assign("productCode",$_POST["productCode"]);

		$found = false;
		$i = 0;
		//Busco el producto
		while ($i<count($items) && !$found) {
			$item = $items[$i];
			if ($item->getProductCode() == $_POST["productCode"]) {
				unset($_SESSION["orderItems"][$i]);
				$found = true;
			}
			$i++;
		}
		//Si no estaba, no hago nada
		if (!$found) {

		}
		else {
		//Tengo que rearmar el array de items, sino queda un elemento vacio
			$items = $_SESSION["orderItems"];
			unset($_SESSION["orderItems"]);
			$newItems = array();
			$total = 0;
			foreach ($items as $item) {
				if (!empty($item)) {
					$newItems[] = $item;
					$product = $item->getProduct();
					$total += ( $product->getPrice() * $product->getSalesUnit() * $item->getQuantity() );
				}
			}
			$_SESSION["orderItems"] = $newItems;
			$smarty->assign("total",$total);
		}

		return $mapping->findForwardConfig('success');
	}

}
